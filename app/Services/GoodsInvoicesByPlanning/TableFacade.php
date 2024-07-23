<?php

namespace App\Services\GoodsInvoicesByPlanning;

use App\Models\Container;
use App\Models\Document;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData($id)
    {
        $relationFields = ['goods.packages' => function ($q) {
            $q->where('packages.type_id', 2);
        }];
        $goodInvoices = Document::with($relationFields)
            ->whereHas('documentType', function ($q) {
                $q->where('key', 'tovarna_nakladna');
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
