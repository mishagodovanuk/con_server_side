<?php

namespace App\Services\TransportRequest;

use App\Models\Container;
use App\Models\Document;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = [];
        $containers = Document::whereHas('documentType', function ($q) {
            $q->where('key', 'zapyt_na_transport');
        });

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $containers);
    }
}
