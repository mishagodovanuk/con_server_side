<?php

namespace App\Services\Matches\ReverseLoading\CargoRequest;

use App\Models\Document;
use App\Models\Settlement;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\DB;

class TableFacade
{

    public static function getFilteredData()
    {

        $relationFields = [];

        $documents = Document::leftJoin('document_types', 'documents.type_id', '=', 'document_types.id')
            ->where('document_types.key', 'zapyt_na_vantazh')
            ->select(
                'document_types.key',
                'documents.*',
            );


        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $documents);
    }
}
