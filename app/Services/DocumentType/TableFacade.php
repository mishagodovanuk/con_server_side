<?php

namespace App\Services\DocumentType;

use App\Models\Document;

use App\Services\Table\TableFilter;
use App\Services\Table\TableSort;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = [];
        $documents = Document::find($_GET['document_id'])->relatedDocuments()->select();

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);

        return $filter->filter($relationFields,$documents);
    }
}
