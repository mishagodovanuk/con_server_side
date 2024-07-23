<?php

namespace App\Services\ServiceInDocument;

use App\Models\ServiceByDocument;
use App\Services\ContainerInDocument\FormatTableData;
use App\Services\Table\TableFilter;
use App\Services\Table\TableSort;

class TableFacade
{
    public static function getFilteredData(){
        $services = ServiceByDocument::where('document_id',$_GET['document_id'])->select();

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);

        return $filter->filter([],$services);
    }
}
