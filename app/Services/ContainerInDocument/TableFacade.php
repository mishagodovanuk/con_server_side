<?php

namespace App\Services\ContainerInDocument;

use App\Models\ContainerByDocument;

use App\Services\Table\TableFilter;
use App\Services\Table\TableSort;

class TableFacade
{
    public static function getFilteredData(){
        $containers = ContainerByDocument::where('document_id',$_GET['document_id'])->select();

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);

        return $filter->filter([],$containers);
    }
}
