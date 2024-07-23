<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Models\Workspace;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = ['company', 'address', 'type'];
        $companies = Company::with($relationFields)->filterByWorkspace()
            ->leftJoin('legal_companies', function ($join) {
                $join->on('companies.company_id', '=', 'legal_companies.id')
                    ->where('companies.company_type_id', '=', 2);
            })->leftJoin('physical_companies', function ($join) {
                $join->on('companies.company_id', '=', 'physical_companies.id')
                    ->where('companies.company_type_id', '=', 1);
            })->leftJoin('address_details', 'companies.address_id', '=', 'address_details.id')
            ->leftJoin('settlements', 'address_details.settlement_id', '=', 'settlements.id')
            ->leftJoin('streets', 'address_details.street_id', '=', 'streets.id')
            ->select(
                'address_details.*',
                'settlements.name AS settlement_name',
                'streets.name AS street_name',
                'legal_companies.*',
                'physical_companies.*',
                'companies.*',
            );



        $formatTable = new FormatTableData();

        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $companies);
    }
}
