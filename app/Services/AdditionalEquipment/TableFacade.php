<?php

namespace App\Services\AdditionalEquipment;

use App\Models\AdditionalEquipment;
use App\Models\Workspace;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\DB;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = ['company', 'model.brand',
            'transport' => function ($q) {
                $q->with(['model', 'brand']);
            }];
        $additionalEqipments = AdditionalEquipment::with($relationFields)
            ->where('workspace_id', Workspace::current())
            ->leftJoin(DB::raw("(SELECT transports.id, transport_brands.name as brand_name, transport_models.name as model_name FROM transports LEFT JOIN transport_brands ON transports.brand_id = transport_brands.id LEFT JOIN transport_models ON transports.model_id = transport_models.id) as transport_info"), 'additional_equipment.transport_id', '=', 'transport_info.id')
            ->leftJoin(DB::raw("(SELECT additional_equipment.id as new_id, (SELECT GROUP_CONCAT(transport_downloads.name SEPARATOR '|') FROM transport_downloads WHERE FIND_IN_SET(transport_downloads.id, replace(replace(replace(replace(additional_equipment.download_methods, '\"', ''), '[', ''), ']', ''), ' ', ''))) as new_download_methods from additional_equipment) as methods"), 'additional_equipment.id', '=', 'methods.new_id')
            ->leftJoin('additional_equipment_brands', 'additional_equipment.brand_id', '=', 'additional_equipment_brands.id')
            ->leftJoin('additional_equipment_models', 'additional_equipment.model_id', '=', 'additional_equipment_models.id')
            ->leftJoin(DB::raw("(SELECT companies.id, CASE WHEN companies.company_type_id = 1 THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname) ELSE legal_companies.name END as name FROM companies LEFT JOIN physical_companies ON companies.company_id = physical_companies.id LEFT JOIN legal_companies ON companies.company_id = legal_companies.id) as company_with_details"), 'additional_equipment.company_id', '=', 'company_with_details.id')
            ->select('additional_equipment.*','additional_equipment.id');
        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $additionalEqipments);
    }
}
