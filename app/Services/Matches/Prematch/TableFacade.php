<?php

namespace App\Services\Matches\Prematch;


use App\Models\Document;
use App\Models\Match\Consolidation;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\DB;

class TableFacade
{

    public static function getFilteredData()
    {

        $relationFields = ['transportPlanning'];

        $consolidation = Consolidation::with($relationFields)->where('type', $_GET['type']);

        if (isset($_GET['status'])) {
            $consolidation->where('status', $_GET['status']);
        } else {
            $consolidation->where('status', '!=', 'draft');
        }


        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $consolidation);
    }
}
