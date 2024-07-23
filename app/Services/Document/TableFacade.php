<?php

namespace App\Services\Document;

use App\Models\Document;

use App\Services\Table\TableFilter;
use App\Services\Table\TableSort;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = ['documentType','status'];
        $documents = Document::with($relationFields)->currentWorkspace()->where('type_id',$_GET['document_id'])->select();

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);

        return $filter->filter($relationFields,$documents);
    }
}
