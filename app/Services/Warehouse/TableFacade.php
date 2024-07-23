<?php

namespace App\Services\Warehouse;

use App\Models\Container;
use App\Models\Warehouse;
use App\Models\Workspace;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\DB;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = ['address', 'type', 'company', 'user'];
        $warehouses = Warehouse::with($relationFields)->leftJoin('address_details', 'warehouses.address_id', '=', 'address_details.id')
            ->leftJoin('settlements', 'address_details.settlement_id', '=', 'settlements.id')
            ->leftJoin('streets', 'address_details.street_id', '=', 'streets.id')
            ->where('warehouses.workspace_id', Workspace::current())
            ->select(
                'address_details.*',
                'settlements.name AS settlement_name',
                'streets.name AS street_name',
                'warehouses.*',
            );

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $warehouses);
    }
}
