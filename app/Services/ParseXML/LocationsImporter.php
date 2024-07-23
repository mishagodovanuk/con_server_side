<?php

namespace App\Services\ParseXML;

use App\Helpers\GeocodingHelper;
use App\Models\AddressDetails;
use App\Models\Company;
use App\Models\Country;
use App\Models\Region;
use App\Models\Settlement;
use App\Models\Street;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;
use Throwable;

class LocationsImporter
{
    const COUNTRY_KEY = 'ukraine';

    private $ukraineID;

    private $contragentsArray;




    public function __construct()
    {
        $this->contragentsArray = Company::where('workspace_id', 1)->pluck('id', 'erp_id')->all();
    }

    // splitting db insert into 2 parts

    public function import(string $url)
    {
        $contents = file_get_contents($url . '/contr.XML');
        $xml = new SimpleXMLElement($contents);
        $this->initData();

        $this->addYarychWarehouses();

        $existingLocationID = $this->getExistingLocationID();

        $i = 1;
        foreach ($xml->DeliveryPoints->DeliveryPoint as $location) {
            if ($i > 4522) {
                $this->importLocation($location, $existingLocationID);
            }

            $i++;
        }
    }

    private function initData()
    {
        $this->ukraineID = Country::where('key', self::COUNTRY_KEY)->first('id')->id;
    }

    private function getExistingLocationID()
    {
        $locations = Warehouse::select(['erp_id'])->get();
        return $locations->pluck('erp_id')->toArray();
    }

    private function clearSettlement($settlement)
    {
        $wordsToDelete = [' місто', 'місто ', 'місто', 'c. ', 'c.'];

        foreach ($wordsToDelete as $item) {
            $settlement = str_replace($item, '', $settlement);
        }

        return $settlement;
    }

    private function clearStreet($street)
    {
        $wordsToDelete = ['вул. ', 'вул.', 'пр. ', 'пр.', 'пров ', 'пров', ' вулиця', 'вулиця ', 'прос. ', 'прос.', ' шосе', 'шосе '];

        foreach ($wordsToDelete as $item) {
            $street = str_replace($item, '', $street);
        }

        return $street;
    }

    private function parseAddress(string $address): array
    {
        $result = [];

        // Розбиваємо адресу на частини, використовуючи кому як роздільник
        $parts = explode(',', $address);

        // Визначаємо область і видаляємо її з масиву $parts, якщо вона є в першому елементі
        $firstPart = trim($parts[0]);
        if (strpos($firstPart, 'область') !== false) {
            $result['region'] = $firstPart;
            array_shift($parts); // Видаляємо перший елемент масиву
        }

        // Визначаємо район і видаляємо її з масиву $parts, якщо вона є в другому елементі
        $secondPart = trim($parts[0]);
        if (strpos($secondPart, 'район') !== false) {

            array_shift($parts); // Видаляємо другий елемент масиву
        }

        // Оголошуємо окремі змінні для міста і вулиці
        $city = '';
        $street = '';

        // Визначаємо city і вулицю
        if (count($parts) > 0) {
            $city = trim($parts[0]);
        }
        if (count($parts) > 1) {
            $street = trim($parts[1]);
        }

        // Остання частина містить building_number і flat_number (якщо є)
        $lastPart = trim(end($parts));
        $houseAndFlat = explode('/', $lastPart);
        $house = $houseAndFlat[0];
        $flat = isset($houseAndFlat[1]) ? preg_replace('/\s/', '', $houseAndFlat[1]) : null;

        // Залишаємо тільки букви та цифри у номерах будинку і квартирі
        $house = preg_replace("/[^A-Za-z0-9]/", '', $house);

        // Визначаємо, чи є букви або пробіли в номері будинку і вулиці
        $hasLettersOrSpaces = preg_match("/[A-Za-z\s]/", $house) || preg_match("/[A-Za-z\s]/", $street);

        // Додаємо city, вулицю, building_number і flat_number до результату
        if (!$hasLettersOrSpaces) {
            // Видаляємо всі пробіли
            $city = str_replace(' ', '', $city);
            $street = str_replace(' ', '', $street);
            $house = str_replace(' ', '', $house);

            // Розділяємо building_number і flat_number на окремі частини
            $houseParts = preg_split('/(?<=[0-9])(?=[А-ЯA-Z])|(?<=[А-ЯA-Z])(?=[0-9])/', $house, -1, PREG_SPLIT_NO_EMPTY);

            // Визначаємо building_number та flat_number
            $result['building_number'] = $houseParts[0];
            if (isset($houseParts[1])) {
                $result['flat_number'] = $houseParts[1];
            }

            $result['city'] = $city;
            $result['street'] = $street;
        } else {
            // Якщо є букви або пробіли, зберігаємо значення без змін
            $result['city'] = $city;
            $result['street'] = $street;
            $result['building_number'] = $house;
            if ($flat) {
                $result['flat_number'] = $flat;
            }
        }

        return $result;
    }



    private function importLocation($location, $existingLocationID)
    {
        $locationID = $location->CODE->__toString();
        if (in_array($locationID, $existingLocationID)) {
            return;
        }
        $locationName = $location->NAME->__toString();
        $locationAddress = $location->Adress->__toString();
        $locationContragentID = $location->CONTRAGENTCODE->__toString();
        $additionToAddress = $location->AdditionToAdress->__toString();

        try {
            DB::transaction(function () use (
                $locationID, $locationName,
                $locationAddress, $locationContragentID, $additionToAddress
            ) {
                $coordinates = GeocodingHelper::getCoordinates($locationAddress);

                $address = $this->parseAddress($locationAddress);

                if (array_key_exists('region', $address)) {
                    $regionName = explode(' ', $address['region']);
                    $region = Region::where('name', 'like', '%' . $regionName[0])->firstOrFail();
                    $settlement = Settlement::where('region_id', $region->id)->where('name', 'like', '%' . $this->clearSettlement($address['city']))->firstOrFail();
                } else {
                    $settlement = Settlement::where('name', 'like', '%' . $this->clearSettlement($address['city']))->firstOrFail();
                }

                $street = Street::where('name', 'like', '%' . $this->clearStreet($address['street']))->firstOrFail();

                $addressDetails = AddressDetails::create([
                    'settlement_id' => $settlement->id,
                    'street_id' => $street->id,
                    'building_number' => $address['building_number'],
                    'flat_number' => array_key_exists('flat_number', $address)
                        ? $address['flat_number'] : null,
                ]);

                Warehouse::create([
                    'name' => DB::raw("'" . addslashes($locationName) . "'"),
                    'coordinates' => json_encode($coordinates),
                    'address_id' => $addressDetails->id,
                    'company_id' => $this->contragentsArray[$locationContragentID],
                    'addition_to_address' => $additionToAddress,
                    'erp_id' => $locationID,
                    'workspace_id' => 1
                ]);
            });
        } catch (Throwable $e) {
            DB::transaction(function () use (
                $locationID, $locationName,
                $locationAddress, $locationContragentID, $additionToAddress
            ) {

                $coordinates = GeocodingHelper::getCoordinates($locationAddress);
                $addressDetails = AddressDetails::create([
                    'country_id' => $this->ukraineID,
                    'comment' => DB::raw("'" . addslashes($locationAddress) . "'")
                ]);

                Warehouse::create([
                    'name' => DB::raw('"' . addslashes($locationName) . '"'),
                    'coordinates' => json_encode($coordinates),
                    'company_id' => $this->contragentsArray[$locationContragentID],
                    'address_id' => $addressDetails->id,
                    'addition_to_address' => $additionToAddress,
                    'erp_id' => $locationID,
                    'workspace_id' => 1
                ]);
            });

        }
    }


    private function addYarychWarehouses()
    {
        $warehouses = [
            '000000085' => "Склад готової продукції КФ Ярич",
            '000000087' => "Склад сировини та пакувальних матеріалів КФ Ярич",
            '000000033' => "Кондитерський цех (сировина) КФ ЯРИЧ",
            '000000034' => "Цех готова продукція КФ ЯРИЧ",
            '000000035' => "Цех пакувальні матеріали КФ ЯРИЧ",
            '000000036' => "Цех сировина КФ ЯРИЧ",
            '000000041' => "Склад сировини та пакувальних матеріалів КФ (БРАК)",
            '000000024' => 'Сировини і пакувальних матеріалів "КФ"ЯРИЧ" (інші)'
        ];
        $settlement = Settlement::where('name', 'like', '%Старий Яричів%')->first();
        $street = Street::where('name', 'вул.Заводська')->first();
        $coordinates = GeocodingHelper::getCoordinates('с.Старий Яричів вул.Заводська 1');
        foreach ($warehouses as $key => $warehouse) {
            $addressDetails = AddressDetails::create([
                'settlement_id' => $settlement->id,
                'street_id' => $street->id,
                'building_number' => 1
            ]);

            Warehouse::create([
                'name' => $warehouse,
                'coordinates' => json_encode($coordinates),
                'address_id' => $addressDetails->id,
                'company_id' => 1,
                'erp_id' => $key,
                'workspace_id' => 1
            ]);
        }

        $settlement = Settlement::where('name', 'с.Муроване')->first();
        $street = Street::where('name', 'вул.Тополина')->first();
        $coordinates = GeocodingHelper::getCoordinates('с.Муроване вул.Тополина 1');
        $addressDetails = AddressDetails::create([
            'settlement_id' => $settlement->id,
            'street_id' => $street->id,
            'building_number' => 1
        ]);

        Warehouse::create([
            'name' => 'Відповідального зберігання ТОВ Болеро С (гот прод)',
            'coordinates' => json_encode($coordinates),
            'address_id' => $addressDetails->id,
            'company_id' => 1,
            'erp_id' => '000000150',
            'workspace_id' => 1
        ]);
    }
}
