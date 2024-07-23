<?php

namespace App\Services\DocumentTypeInDocumentTable;

use App\Models\Document;

use App\Services\Table\TableFilter;
use App\Services\Table\TableSort;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = ['documentType','status'];
        $documents = Document::with($relationFields)->where('type_id',$_GET['type_id'])
            ->select();
        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);

        return $filter->filter($relationFields,$documents);
    }
}
