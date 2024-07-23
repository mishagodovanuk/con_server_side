<?php

namespace App\Services\ParseXML;

use App\Models\Company;
use App\Models\Container;
use App\Models\ContainerType;
use App\Models\Country;
use App\Models\Goods;
use App\Models\Leftover;
use App\Models\MeasurementUnit;
use App\Models\Package;
use App\Models\SKUCategory;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class LeftoversImporter
{

    private $goodsCategoryID, $rawStuffCategoryId, $manufacturerID, $companyID, $measurementUnitID, $containerTypeID;

    private $containerKeyWords;
    private $raw_stuff_keywords;

    private $containersArray, $goodsArray, $warehousesArray;

    public function __construct()
    {
        $warehouseIds = Warehouse::where('workspace_id', 1)
            ->where('erp_id', '!=', null)
            ->pluck('id')->all();

        Leftover::whereIn('warehouse_id', $warehouseIds)
            ->where('erp_id', '!=', null)
            ->delete();

        $this->goodsArray = Goods::where('workspace_id', 1)
            ->where('erp_id', '!=', null)->pluck('id', 'erp_id')->all();

        $this->containersArray = Container::where('workspace_id', 1)
            ->where('erp_id', '!=', null)->pluck('id', 'erp_id')->all();
        $this->warehousesArray = Warehouse::where('workspace_id', 1)
            ->where('erp_id', '!=', null)->pluck('id', 'erp_id')->all();

        $this->containerKeyWords = include('YARYCH Arrays/container.php');
        $this->raw_stuff_keywords = include('YARYCH Arrays/raw_stuff_keywords.php');

        $this->goodsCategoryID = SKUCategory::find(1)->id;
        $this->rawStuffCategoryId = SKUCategory::where('key', 'raw')->first()->id;
        $this->manufacturerID = Country::find(1)->id;
        $this->companyID = Company::find(1)->id;
        $this->containerTypeID = ContainerType::find(1)->id;
        $this->measurementUnitID = MeasurementUnit::where('key', 'box')->first()->id;
    }

    public function import($url)
    {
        $contents = file_get_contents($url . '/ost.XML');
        $xml = new SimpleXMLElement($contents);

        $existingLeftoversID = $this->existingLeftoversID();

        foreach ($xml->Ost as $leftover) {
            $this->createLeftover($leftover, $existingLeftoversID);
        }
    }

    private function existingLeftoversID()
    {
        $goods = Leftover::select(['erp_id'])->get();
        return $goods->pluck('erp_id')->toArray();
    }

    private function isGoodsExists($id)
    {
        return array_key_exists($id, $this->goodsArray);
    }

    private function isContainerExists($id)
    {
        return array_key_exists($id, $this->containersArray);
    }

    private function isLocationExists($id)
    {
        return array_key_exists($id, $this->warehousesArray);
    }

    private function createLeftover($leftover, $existingLeftoversID)
    {
        try {
            $leftoverID = crc32($leftover->SERIES->SERIESID->__toString());
            $skuID = $leftover->SCUCODE->__toString();
            if (!in_array($leftoverID, $existingLeftoversID)) {
                $skuName = $leftover->SCUNAME->__toString();
                if ($this->checkKeyWords($this->containerKeyWords, $skuName)) {
                    $this->storeContainerLeftover($skuID, $leftoverID, $leftover, $skuName);
                } else if ($this->checkKeyWords($this->raw_stuff_keywords, $skuName)) {
                    $this->storeGoodsLeftover($skuID, $leftoverID, $leftover, $this->rawStuffCategoryId, $skuName);
                } else {
                    $this->storeGoodsLeftover($skuID, $leftoverID, $leftover, $this->goodsCategoryID, $skuName);
                }
            }

        } catch (\Exception $e) {
            Log::info('Error for: ' . $leftover->SERIES->SERIESID->__toString());
            dd($leftover->SERIES->SERIESID->__toString() . ": " . $e);
        }
    }

    private function getInfo($skuName): array
    {
        // Use regular expressions to extract the values
        preg_match_all('/([\d,\.]+)(?=\s*(кг|г|\*)|$)/u', $skuName, $matches);

        // Extracted values will be in $matches[1]
        $values = $matches[1];

        // Replace commas with dots to make it a valid float
        $values = array_map(function ($value) {
            return str_replace(',', '.', $value);
        }, $values);

        // Convert values to floats
        $values = array_map('floatval', $values);
        $packageWeight = array_key_exists(0, $values) ? $values[0] : null;
        $count = array_key_exists(1, $values) ? $values[1] : null;
        $weight = array_key_exists(2, $values) ? $values[2] : null;

        return [$packageWeight, $count, $weight];
    }

    private function checkKeyWords($array, $string)
    {
        foreach ($array as $value) {
            // Check if the value exists in the input string
            if (strpos($string, $value) !== false) {
                // Value found in the string
                return true;
            }
        }

        return false;
    }

    private function storeGoodsLeftover($skuID, $leftoverID, $leftover, $categoryID, $skuName)
    {
        if ($this->isGoodsExists($skuID)) {
            if ($this->isLocationExists($leftover->STORAGECODE->__toString())) {
                Leftover::create([
                    'erp_id' => $leftoverID,
                    'goods_id' => $this->goodsArray[$skuID],
                    'count' => (integer)$leftover->QTY->__toString(),
                    'consignment' => $leftover->SERIES->SERIALNUMBER->__toString(),
                    'warehouse_id' => $this->warehousesArray[$leftover->STORAGECODE->__toString()],
                    'leftovers_type' => 'goods',
                ]);
            } else {
                Log::info($leftover->STORAGECODE->__toString());
                Log::info($leftover->STORAGENAME->__toString());
            }

        } else {

            [$packageWeight, $count, $weight] = $this->getInfo($skuName);

            $goods = Goods::create([
                'erp_id' => $skuID,
                'company_id' => $this->companyID,
                'category_id' => $categoryID,
                'manufacturer_country_id' => $this->manufacturerID,
                'measurement_unit_id' => $this->measurementUnitID,
                'name' => $skuName,
                'weight_netto' => $weight,
                'weight_brutto' => $weight,
                'manufacturer_id' => 1,
                'workspace_id' => 1
            ]);

            Package::create([
                'type_id' => 1,
                'number' => $count,
                'goods_id' => $goods->id,
                'weight' => $packageWeight,
            ]);

            if ($this->isLocationExists($leftover->STORAGECODE->__toString())) {
                Leftover::create([
                    'erp_id' => $leftoverID,
                    'goods_id' => $goods->id,
                    'count' => (integer)$leftover->QTY->__toString(),
                    'consignment' => $leftover->SERIES->SERIALNUMBER->__toString(),
                    'warehouse_id' => $this->warehousesArray[$leftover->STORAGECODE->__toString()],
                    'leftovers_type' => 'goods',
                ]);
            } else {
                Log::info($leftover->STORAGECODE->__toString());
                Log::info($leftover->STORAGENAME->__toString());
            }
        }
    }

    private function storeContainerLeftover($skuID, $leftoverID, $leftover, $skuName)
    {
        if ($this->isContainerExists($skuID)) {
            Leftover::create([
                'erp_id' => $leftoverID,
                'container_id' => $this->containersArray[$skuID],
                'count' => (integer)$leftover->QTY->__toString(),
                'consignment' => $leftover->SERIES->SERIALNUMBER->__toString(),
                'warehouse_id' => $this->warehousesArray[$leftover->STORAGECODE->__toString()],
                'leftovers_type' => 'container',
            ]);

            if ($this->isLocationExists($leftover->STORAGECODE->__toString())) {
                Leftover::create([
                    'erp_id' => $leftoverID,
                    'container_id' => $this->containersArray[$skuID],
                    'count' => (integer)$leftover->QTY->__toString(),
                    'consignment' => $leftover->SERIES->SERIALNUMBER->__toString(),
                    'warehouse_id' => $this->warehousesArray[$leftover->STORAGECODE->__toString()],
                    'leftovers_type' => 'container'
                ]);
            } else {
                Log::info($leftover->STORAGECODE->__toString());
                Log::info($leftover->STORAGENAME->__toString());
            }
        } else {

            $container = Container::create([
                'erp_id' => $skuID,
                'uniq_id' => $skuID,
                'name' => $skuName,
                'type_id' => $this->containerTypeID,
                'company_id' => 1,
                'workspace_id' => 1
            ]);


            if ($this->isLocationExists($leftover->STORAGECODE->__toString())) {
                Leftover::create([
                    'erp_id' => $leftoverID,
                    'container_id' => $container->id,
                    'count' => (integer)$leftover->QTY->__toString(),
                    'consignment' => $leftover->SERIES->SERIALNUMBER->__toString(),
                    'warehouse_id' => $this->warehousesArray[$leftover->STORAGECODE->__toString()],
                    'leftovers_type' => 'container'
                ]);
            } else {
                Log::info($leftover->STORAGECODE->__toString());
                Log::info($leftover->STORAGENAME->__toString());
            }
        }
    }
}
