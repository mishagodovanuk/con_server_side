<?php

namespace App\Services\Service;

use App\Models\Service;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = ['category'];
        $service = Service::currentWorkspace()->with($relationFields);

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);
        return $filter->filter($relationFields,$service);
    }
}
