<?php

namespace App\Services\Warehouse;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($warehouse)
    {
        $warehouseArr = [];

        for ($i = 0; $i < count($warehouse); $i++) {
            $warehouseArr[] = $warehouse[$i]->toArray();

            if ($warehouse[$i]->company->company_type_id == 1) {
                $warehouseArr[$i]['company'] = "{$warehouse[$i]->company->company->first_name} {$warehouse[$i]->company->company->surname}";
            } else {
                $warehouseArr[$i]['company'] = $warehouse[$i]->company->company->name;
            }
            $warehouseArr[$i]['type'] = $warehouse[$i]->type?->name;

            if ($warehouse[$i]->address?->settlement?->name && $warehouse[$i]->address?->street?->name
                && $warehouse[$i]->address?->building_number) {
                $warehouseArr[$i]['location'] = $warehouse[$i]->address->settlement->name . ' '
                    . $warehouse[$i]->address->street->name . ' ' . $warehouse[$i]->address->building_number;
            } else {
                $companyArr[$i]['address'] = $warehouse[$i]->address->comment;
            }

            $warehouseArr[$i]['contact'] = "{$warehouse[$i]->user?->surname} {$warehouse[$i]->user?->name}";
        }

        return TableCollectionResource::make(array_values($warehouseArr))->setTotal($warehouse->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'name') {
            $fieldName = 'warehouses.name';
        } else if ($fieldName == 'location') {
            $fieldName = DB::raw("CONCAT(settlements.name, ' ', streets.name, ' ', address_details.`building_number`)");
        }

        return $fieldName;
    }

    public function relationsByField($fieldName)
    {
        if ($fieldName == 'contact') {
            $fieldName = 'user';
        }

        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

        if ($relationName == 'company') {
            $select = "CASE WHEN companies.company_type_id = 1 THEN (SELECT CONCAT(physical_companies.first_name, ' ', physical_companies.surname) FROM physical_companies WHERE physical_companies.id = companies.company_id) WHEN companies.company_type_id = 2 THEN (SELECT legal_companies.name FROM legal_companies WHERE legal_companies.id = companies.company_id) END";
        } else if ($relationName == 'type') {
            $select = 'warehouse_types.name';
        } else if ($relationName == 'user') {
            $select = "CONCAT(users.surname,' ',users.name)";
        }

        return $select;
    }
}
