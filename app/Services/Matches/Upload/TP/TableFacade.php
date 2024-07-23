<?php

namespace App\Services\Matches\Upload\TP;

use App\Models\TransportPlanning;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = ['documents'];

        $transportPlanning = TransportPlanning::with($relationFields)
            ->whereHas('documents', function ($query) {
                $query->whereHas('documentType', function ($typeQuery) {
                    $typeQuery->where('key', 'tovarna_nakladna');
                });
            })
            ->where('is_reserved',0)
            ->select();

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $transportPlanning);
    }
}
