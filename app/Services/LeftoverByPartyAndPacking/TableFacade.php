<?php

namespace App\Services\LeftoverByPartyAndPacking;

use App\Models\Leftover;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = ['goods', 'packages'];
        $leftovers = Leftover::with($relationFields)->select(['*', 'goods.party as party', 'packages.name as package', 'goods.name as sku']);

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);
        return $filter->filter($relationFields,$leftovers);
    }
}
