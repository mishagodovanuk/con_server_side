<?php

namespace App\Services\ParseXML;

use App\Models\Barcode;
use App\Models\Company;
use App\Models\Country;
use App\Models\Goods;
use App\Models\MeasurementUnit;
use App\Models\Package;
use App\Models\SKUCategory;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class SKUImporter
{

    private $categoryID, $manufacturerID, $companyID, $measurementUnitID,$cargoTypeID;

    public function __construct()
    {
        $this->categoryID = 1;
        $this->manufacturerID = 1;
        $this->companyID = 1;
        $this->cargoTypeID = 1;
        $this->measurementUnitID = MeasurementUnit::where('key', 'box')->first()->id;
    }

    public function import($url)
    {
        $contents = file_get_contents($url . '/Test.XML');
        $xml = new SimpleXMLElement($contents);


        foreach ($xml->PRODUCTS->PRODUCT as $sku) {
            $this->createSKU($sku);
        }
    }

    private function IsGoodsExist(int $id): bool
    {
        return Goods::where('erp_id', $id)->exists();
    }

    private function createSKU($sku)
    {

        try {
            $skuID = $sku->ID->__toString();
            if (!$this->IsGoodsExist($skuID)) {
                $skuName = $sku->NAME->__toString();
                [$count, $weight, $packageWeight] = $this->getInfo($sku);
                $goods = Goods::create([
                    'erp_id' => $skuID,
                    'company_id' => $this->companyID,
                    'cargo_type_id' => $this->cargoTypeID,
                    'category_id' => $this->categoryID,
                    'manufacturer_country_id' => $this->manufacturerID,
                    'measurement_unit_id' => $this->measurementUnitID,
                    'name' => $skuName,
                    'weight_netto' => $weight,
                    'weight_brutto' => $weight,
                    'manufacturer_id' => 1,
                    'workspace_id' => 1
                ]);

                $package = Package::create([
                    'type_id' => 1,
                    'number'=> $count,
                    'goods_id' => $goods->id,
                    'weight' => $packageWeight+0.3,
                    'weight_brutto' => $packageWeight,
                ]);

                $barcode = Barcode::create([
                    'barcode' => intval($sku->BARCODE->__toString()),
                    'goods_id' => $goods->id
                ]);

            }

        } catch (\Exception $e) {
            Log::info('Error for: ' . $skuID);
            dd($skuID . ": " . $e);
        }
    }

    private function convertToNumber(string $number): float|int
    {
        return (float)str_replace(',', '.', $number);
    }

    private function getInfo($sku) : array
    {
        $string = $sku->NAME->__toString();

        $count = null;
        $weight = null;
        $packageWeight = $this->convertToNumber($sku->WEIGHT->__toString());
        $pattern = '/(\d+)\*(\d+)/';

        if (preg_match($pattern, $string, $matches)) {
            $count = (int)$matches[1];
            $weight = (int)$matches[2];
        }

        return [$count, $weight, $packageWeight];
    }

}
