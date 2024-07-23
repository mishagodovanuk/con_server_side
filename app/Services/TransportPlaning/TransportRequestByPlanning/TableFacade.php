<?php

namespace App\Services\TransportPlaning\TransportRequestByPlanning;

use App\Models\Container;
use App\Models\Document;
use App\Services\Table\TableFilter;
use App\Services\TransportRequest\FormatTableData;
use App\Services\TransportRequest\TableSort;

class TableFacade
{
    public static function getFilteredData($id)
    {
        $relationFields = ['documentType','transport_plannings'];

        $goodInvoices = Document::with($relationFields)
            ->whereHas('documentType', function ($q) {
                $q->where('key', 'zapyt_na_transport');
            })
            ->whereHas('transport_plannings', function ($q) use ($id) {
                $q->where('transport_plannings.id', $id);
            });


        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $goodInvoices);
    }
}
