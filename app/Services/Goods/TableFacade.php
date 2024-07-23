<?php

namespace App\Services\Goods;

use App\Models\Goods;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = ['company.company', 'manufacturer_country', 'manufacturer.company', 'category'];
        $goods = Goods::currentWorkspace()->with($relationFields);

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);
        return $filter->filter($relationFields,$goods);
    }
}
