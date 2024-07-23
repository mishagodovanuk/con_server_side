<?php

namespace App\Services\Transport;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($transports)
    {
        $transportsArr = [];
        for ($i = 0; $i < count($transports); $i++) {
            $transportsArr[] = $transports[$i]->toArray();

            if ($transports[$i]->company->company_type_id == 1) {
                $transportsArr[$i]['company'] = "{$transports[$i]->company->company->surname} {$transports[$i]->company->company->first_name}";
            } else {
                $transportsArr[$i]['company'] = $transports[$i]->company->company->name;
            }
            $transportsArr[$i]['category'] = $transports[$i]->category->name;
            $transportsArr[$i]['type'] = $transports[$i]->type->name;
            $transportsArr[$i]['defaultDriver'] = "{$transports[$i]->driver->surname} {$transports[$i]->driver->name}";
            $transportsArr[$i]['licensePlate'] = $transports[$i]->license_plate;
            $transportsArr[$i]['model'] = "{$transports[$i]->brand->name} {$transports[$i]->model->name}";
        }

        return TableCollectionResource::make(array_values($transportsArr))->setTotal($transports->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'licensePlate') {
            $fieldName = DB::raw("license_plate");
        } else if ($fieldName == 'model') {
            $fieldName = DB::raw("CONCAT(transport_brands.name, ' ', transport_models.name)");
        } else if ($fieldName == 'defaultDriver') {
            $fieldName = DB::raw("CONCAT(users.surname, ' ', users.name)");
        } else if($fieldName=='type'){
            $fieldName = "transport_types.name";
        } else if ($fieldName == 'category') {
            $fieldName = "transport_categories.name";
        }

        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

        if ($relationName == 'company') {
            $select = "CASE WHEN companies.company_type_id = 1 THEN (SELECT CONCAT(physical_companies.surname, ' ', physical_companies.first_name) FROM physical_companies WHERE physical_companies.id = companies.company_id) WHEN companies.company_type_id = 2 THEN (SELECT legal_companies.name FROM legal_companies WHERE legal_companies.id = companies.company_id) END";
        }

        return $select;
    }
}
