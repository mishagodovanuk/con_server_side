<?php

namespace App\Services\AdditionalEquipment;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($additionalEquipments)
    {
        $additionalEquipmentsArr = [];
        for ($i = 0; $i < count($additionalEquipments); $i++) {
            $additionalEquipmentsArr[] = $additionalEquipments[$i]->toArray();

            if ($additionalEquipments[$i]->company->company_type_id == 1) {
                $additionalEquipmentsArr[$i]['company'] = "{$additionalEquipments[$i]->company->company->first_name} {$additionalEquipments[$i]->company->company->surname}";
            } else {
                $additionalEquipmentsArr[$i]['company'] = $additionalEquipments[$i]->company->company->name;
            }
            $additionalEquipmentsArr[$i]['dnz'] = $additionalEquipments[$i]->license_plate;
            $additionalEquipmentsArr[$i]['model'] = "{$additionalEquipments[$i]->brand->name} {$additionalEquipments[$i]->model->name}";
            $additionalEquipmentsArr[$i]['car'] = "{$additionalEquipments[$i]->transport->brand->name} {$additionalEquipments[$i]->transport->model->name}";
            $additionalEquipmentsArr[$i]['typeLoad'] = implode('|', $additionalEquipments[$i]->downloadMethods()->values()->toArray());
        }

        return TableCollectionResource::make(array_values($additionalEquipmentsArr))->setTotal($additionalEquipments->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'model') {
            $fieldName = DB::raw("CONCAT(additional_equipment_brands.name, ' ', additional_equipment_models.name)");
        } else if ($fieldName == 'dnz') {
            $fieldName = DB::raw('license_plate');
        } else if ($fieldName == 'car') {
            $fieldName = DB::raw("CONCAT(transport_info.brand_name, ' ', transport_info.model_name)");
        } else if ($fieldName == 'typeLoad') {
            $fieldName = DB::raw("methods.new_download_methods");
        }

        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

         if ($relationName == 'company') {
            $select = "CASE WHEN companies.company_type_id = 1 THEN (SELECT CONCAT(physical_companies.first_name, ' ', physical_companies.surname) FROM physical_companies WHERE physical_companies.id = companies.company_id) WHEN companies.company_type_id = 2 THEN (SELECT legal_companies.name FROM legal_companies WHERE legal_companies.id = companies.company_id) END";
        }

        return $select;
    }

}
