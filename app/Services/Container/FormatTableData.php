<?php

namespace App\Services\Container;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($container)
    {
        $containerArr = [];
        for ($i = 0; $i < count($container); $i++) {
            $containerArr[] = $container[$i]->toArray();
            if ($container[$i]->company->company_type_id == 1) {
                $containerArr[$i]['company'] = "{$container[$i]->company->company->first_name} {$container[$i]->company->company->surname}";
            } else {
                $containerArr[$i]['company'] = $container[$i]->company->company->name;
            }
            $containerArr[$i]['type'] = $container[$i]->type->name;

        }

        return TableCollectionResource::make(array_values($containerArr))->setTotal($container->total());
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

        if ($relationName == 'company') {
            $select = "CASE WHEN companies.company_type_id = 1 THEN (SELECT CONCAT(physical_companies.first_name, ' ', physical_companies.surname) FROM physical_companies WHERE physical_companies.id = companies.company_id) WHEN companies.company_type_id = 2 THEN (SELECT legal_companies.name FROM legal_companies WHERE legal_companies.id = companies.company_id) END";
        } else if ($relationName == 'type') {
            $select = 'container_types.name';
        }

        return $select;
    }
}
