<?php

namespace App\Services\ParseXML;

use App\Models\AddressDetails;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\CompanyType;
use App\Models\Country;
use App\Models\LegalCompany;
use App\Models\PhysicalCompany;
use App\Models\Workspace;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class ContragentsImporter
{

    const COUNTRY_KEY = 'ukraine';
    const COMPANY_TYPE_LEGAL = 'legal';
    const COMPANY_TYPE_PHYSICAL = 'physical';

    private $ukraineID;
    private $legalID;
    private $physicalID;

    public function import($url)
    {
        $contents = file_get_contents($url . '/contr.XML');
        $xml = new SimpleXMLElement($contents);
        $this->initData();

        $existingPhysicalCompanies = $this->getExistingPhysicalCompanies();

        $existingLegalCompanies = $this->getExistingLegalCompanies();

        foreach ($xml->CONTR->CONTRAGENT as $contragent) {
            $this->importGroup($contragent, $contragent->NAME->__toString());
        }


        foreach ($xml->CONTR->CONTRAGENT as $contragent) {
            $this->importContragent($contragent, $existingPhysicalCompanies, $existingLegalCompanies);
        }
    }

    private function initData()
    {
        $this->ukraineID = Country::where('key', self::COUNTRY_KEY)->first('id')->id;
        $this->legalID = CompanyType::where('key', self::COMPANY_TYPE_LEGAL)->first()->id;
        $this->physicalID = CompanyType::where('key', self::COMPANY_TYPE_PHYSICAL)->first()->id;
    }

    private function getExistingPhysicalCompanies()
    {
        $physicalCompanies = PhysicalCompany::select(['first_name', 'surname', 'patronymic'])->get();
        $physicalCompaniesArray = $physicalCompanies->toArray();

        return array_map(function ($company) {
            return implode(' ', $company);
        }, $physicalCompaniesArray);
    }

    private function getExistingGroup()
    {
        $groups = Workspace::where('user_id', 1)->get(['id', 'name']);

        $result = [];

        foreach ($groups as $group) {
            $result[$group->name . $group->id] = $group->id;
        }

        return $result;
    }

    private function getExistingLegalCompanies()
    {
        $legalCompanies = LegalCompany::select(['name'])->get();
        return $legalCompanies->pluck('name')->toArray();
    }

    private function importContragent($contragent, $existingPhysicalCompanies, $existingLegalCompanies)
    {
        $contragentName = $contragent->NAME->__toString();

        try {
            if ($this->isPhysicalCompany($contragentName)) {
                $this->importPhysicalCompany($contragent, $contragentName, $existingPhysicalCompanies);
            } else {
                $this->importLegalCompany($contragent, $contragentName, $existingLegalCompanies);
            }
        } catch (\Throwable $e) {
            Log::info('Error for: ' . $contragentName);
        }
    }

    private function isPhysicalCompany($contragentName)
    {
        return preg_match('/^ФОП|ФОП\s*$/', $contragentName);
    }

    private function importGroup($contragent, $contragentName)
    {
        $existingGroupArray = $this->getExistingGroup();

        if ($contragent->ISGROUP->__toString() == "Так" && !array_key_exists($contragentName . intval($contragent->CODE->__toString()), $existingGroupArray)) {
            CompanyCategory::updateOrCreate([
                'id' => intval($contragent->CODE->__toString()),
                'name' => $contragentName,
                'key' => $this->transliterate($contragentName),
                'workspace_id' => 1
            ]);
        }
    }

    private function importPhysicalCompany($contragent, $contragentName, $existingPhysicalCompanies)
    {
        [$surname, $firstName, $patronymic] = $this->extractNamesFromContragentName($contragentName);

        if (in_array($firstName . ' ' . $surname . ' ' . $patronymic, $existingPhysicalCompanies) ||
            $contragent->ISGROUP->__toString() == "Так") {
            return;
        }

        $address = AddressDetails::create(['country_id' => $this->ukraineID]);

        $physicalCompany = PhysicalCompany::create([
            "first_name" => $firstName,
            "surname" => $surname,
            "patronymic" => $patronymic
        ]);

        $company = Company::create([
            'company_type' => 'App\\Models\\PhysicalCompany',
            'company_id' => $physicalCompany->id,
            'company_type_id' => $this->physicalID,
            'address_id' => $address->id,
            'category_id' => intval($contragent->ParentCODE->__toString()),
            'workspace_id' => 1,
            'erp_id' => $contragent->CODE->__toString()
        ]);
    }

    private function importLegalCompany($contragent, $contragentName, $existingLegalCompanies)
    {

        if (in_array($contragentName, $existingLegalCompanies) || $contragent->ISGROUP->__toString() == "Так") {
            return;
        }
        $address = AddressDetails::create(['country_id' => $this->ukraineID]);

        $legalCompany = LegalCompany::create([
            "name" => $contragentName,
        ]);

        $company = Company::create([
            'company_type' => 'App\\Models\\LegalCompany',
            'company_id' => $legalCompany->id,
            'company_type_id' => $this->legalID,
            'address_id' => $address->id,
            'category_id' => intval($contragent->ParentCODE->__toString()),
            'workspace_id' => 1,
            'erp_id' => $contragent->CODE->__toString()
        ]);
    }

    private function extractNamesFromContragentName($contragentName)
    {
        $parts = preg_split('/[\s.]+/', $contragentName);

        $lastName = $parts[0];
        $firstName = str_replace('.', '', $parts[1]);
        $middleName = $parts[2];
        return [$lastName, $firstName, $middleName];
    }

    private function transliterate($text)
    {
        $transliterationTable = array(
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'H', 'Д' => 'D', 'Е' => 'E',
            'Є' => 'Ye', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'Y', 'І' => 'I', 'Ї' => 'Yi',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
            'Х' => 'Kh', 'Ц' => 'Ts', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shch', 'Ь' => '',
            'Ю' => 'Yu', 'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'h', 'д' => 'd', 'е' => 'e',
            'є' => 'ye', 'ж' => 'zh', 'з' => 'z', 'и' => 'y', 'і' => 'i', 'ї' => 'yi',
            'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
            'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ь' => '',
            'ю' => 'yu', 'я' => 'ya',
        );

        return strtr($text, $transliterationTable);
    }

}
