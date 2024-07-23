<?php

namespace App\Services\Goods;

use App\Services\Table\AbstractTableSort;
use Illuminate\Support\Facades\DB;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($_GET['sortdatafield'] == 'company') {
                if (!$this->existsInFilter($_GET['sortdatafield'])) {
                    $model = $model->leftJoin(DB::raw("(SELECT companies.id as first_company_id, (CASE WHEN companies.company_type_id = 1 THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname) ELSE legal_companies.name END) as company_name FROM companies LEFT JOIN physical_companies ON companies.company_id = physical_companies.id LEFT JOIN legal_companies ON companies.company_id = legal_companies.id) as first_companies"), 'goods.company_id', '=', 'first_companies.first_company_id');
                }
                $model = $model->orderBy('first_companies.company_name', $sortOrder);
            } else if ($sortDataField == 'country') {
                $model = $model
                    ->leftJoin('countries', 'goods.manufacturer_country_id', '=', 'countries.id')
                    ->orderBy('countries.name', $sortOrder);

            } else if ($_GET['sortdatafield'] == 'manufacturer') {
                if (!$this->existsInFilter($_GET['sortdatafield'])) {
                    $model = $model->leftJoin(DB::raw("(SELECT companies.id as manufacturer_id, (CASE WHEN companies.company_type_id = 1 THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname) ELSE legal_companies.name END) as manufacturer_name FROM companies LEFT JOIN physical_companies ON companies.company_id = physical_companies.id LEFT JOIN legal_companies ON companies.company_id = legal_companies.id) as second_companies"), 'goods.manufacturer_id', '=', 'second_companies.manufacturer_id');
                }
                $model = $model->orderBy('second_companies.manufacturer_name', $sortOrder);

            } else if ($sortDataField == 'category') {
                $model = $model
                    ->leftJoin('sku_categories', 'goods.category_id', '=', 'sku_categories.id')
                    ->orderBy('sku_categories.name', $sortOrder);

            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }
        }
        return $model;
    }
}
