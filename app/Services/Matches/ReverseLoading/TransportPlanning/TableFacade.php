<?php

namespace App\Services\Matches\ReverseLoading\TransportPlanning;

use App\Models\TransportPlanning;
use App\Services\Matches\Upload\TP\FormatTableData;
use App\Services\Matches\Upload\TP\TableSort;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData()
    {
        $currentFilter = $_GET['tab'];
        $relationFields = ['documents'];

        $transportPlanning = TransportPlanning::with($relationFields)
            ->leftJoin('transport_planning_to_consolidations', 'transport_planning_to_consolidations.tp_id', '=', 'transport_plannings.id')
            ->leftJoin('consolidations', 'transport_planning_to_consolidations.consolidation_id', '=', 'consolidations.id')
            ->where(function ($query) {
                $query->where('type', 'common_ftl')
                    ->orWhere('auto_search', 1)
                    ->whereHas('documents', function ($documentQuery) {
                        $documentQuery->whereHas('documentType', function ($typeQuery) {
                            $typeQuery->where('key', 'tovarna_nakladna');
                        });
                    });
            })
            ->select('transport_plannings.*')
            ->distinct();

        switch ($currentFilter) {
            case 'common_trip':

                break;

            case 'start_point':

                break;

            case 'end_point':

                break;
        }


        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $transportPlanning);
    }
}
