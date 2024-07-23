<?php

namespace App\Services\Container;

use App\Models\Container;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = ['company', 'type'];
        $containers = Container::currentWorkspace()->with($relationFields);

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);
        return $filter->filter($relationFields,$containers);
    }
}
