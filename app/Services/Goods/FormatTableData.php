<?php

namespace App\Services\Goods;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($goods)
    {
        $goodsArr = [];
        for ($i = 0; $i < count($goods); $i++) {
            $goodsArr[] = $goods[$i]->toArray();

            if ($goods[$i]->company->company_type_id == 1) {
                $goodsArr[$i]['company'] = "{$goods[$i]->company->company->first_name} {$goods[$i]->company->company->surname}";
            } else {
                $goodsArr[$i]['company'] = $goods[$i]->company->company->name;
            }

            if ($goods[$i]->manufacturer->company_type_id == 1) {
                $goodsArr[$i]['manufacturer'] = "{$goods[$i]->manufacturer->company->first_name} {$goods[$i]->manufacturer->company->surname}";
            } else {
                $goodsArr[$i]['manufacturer'] = $goods[$i]->manufacturer->company->name;
            }

            $goodsArr[$i]['country'] = $goods[$i]->manufacturer_country->name;
            $goodsArr[$i]['category'] = $goods[$i]->category->name;
        }

        return TableCollectionResource::make(array_values($goodsArr))->setTotal($goods->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'company') {
            $fieldName = DB::raw("company_name");
        } else if ($fieldName == 'manufacturer') {
            $fieldName = DB::raw("manufacturer_name");
        } else if ($fieldName == 'id') {
            $fieldName = DB::raw("goods.id");
        }

        return $fieldName;
    }

    public function relationsByField($fieldName)
    {
        if ($fieldName == 'country') {
            $fieldName = 'manufacturer_country';
        }

        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

        if ($relationName == 'country') {
            $select = "manufacturer_country.name";
        }

        return $select;
    }

    public function joinsByField($fieldName, $model)
    {
        if ($fieldName == 'company') {
            $model->leftJoin(DB::raw("(SELECT companies.id as first_company_id, (CASE WHEN companies.company_type_id = 1 THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname) ELSE legal_companies.name END) as company_name FROM companies LEFT JOIN physical_companies ON companies.company_id = physical_companies.id LEFT JOIN legal_companies ON companies.company_id = legal_companies.id) as first_companies"), 'goods.company_id', '=', 'first_companies.first_company_id');
        } else if ($fieldName == 'manufacturer') {
            $model->leftJoin(DB::raw("(SELECT companies.id as manufacturer_id, (CASE WHEN companies.company_type_id = 1 THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname) ELSE legal_companies.name END) as manufacturer_name FROM companies LEFT JOIN physical_companies ON companies.company_id = physical_companies.id LEFT JOIN legal_companies ON companies.company_id = legal_companies.id) as second_companies"), 'goods.manufacturer_id', '=', 'second_companies.manufacturer_id');
        }

        return $model;
    }
}
