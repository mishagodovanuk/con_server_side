<?php

namespace App\Services\Registers;

use App\Models\Register;

use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData($warehouses_ids)
    {
        $relationFields = ['storekeeper', 'manager', 'download_method', 'download_zone', 'status'];
        $registers = Register::with($relationFields)->select();

        if (!is_null($warehouses_ids)) {
            $registers->whereIn('warehouse_id', $warehouses_ids);
        }

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $registers);
    }
}
