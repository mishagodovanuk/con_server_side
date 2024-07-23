<?php

namespace App\Services\GoodsBarcode;

use App\Models\Barcode;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData($id){
        $relationFields = [];

        $packages = Barcode::with($relationFields)->where('goods_id', $id);

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);
        return $filter->filter($relationFields,$packages);
    }
}
