<?php

namespace App\Services\GoodsInvoices;

use App\Models\Container;
use App\Models\Document;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = ['goods.packages' => function ($q) {
            $q->where('packages.type_id', 2);
        }];
        $containers = Document::with($relationFields)->whereHas('documentType', function ($q) {
            $q->where('key', 'tovarna_nakladna');
        });


        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $containers);
    }
}
