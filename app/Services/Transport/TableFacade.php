<?php

namespace App\Services\Transport;

use App\Models\Transport;
use App\Models\Workspace;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\DB;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = ['company', 'driver', 'model.brand'];
        $transports = Transport::with($relationFields)->where('workspace_id', Workspace::current())->leftJoin('transport_brands', 'transports.brand_id', '=', 'transport_brands.id')
            ->leftJoin('transport_models', 'transports.model_id', '=', 'transport_models.id')
            ->leftJoin('transport_categories', 'transport_categories.id', '=', 'transports.category_id')
            ->leftJoin('transport_types', 'transport_types.id', '=', 'transports.type_id')
            ->leftJoin('users', 'transports.driver_id', '=', 'users.id')
            ->leftJoin(DB::raw("(SELECT companies.id, CASE WHEN companies.company_type_id = 1 THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname) ELSE legal_companies.name END as name FROM companies LEFT JOIN physical_companies ON companies.company_id = physical_companies.id LEFT JOIN legal_companies ON companies.company_id = legal_companies.id) as company_with_details"), 'transports.company_id', '=', 'company_with_details.id')
            ->select(DB::raw("CONCAT(transport_brands.name, ' ', transport_models.name)"), 'transports.*');

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $transports);
    }
}
