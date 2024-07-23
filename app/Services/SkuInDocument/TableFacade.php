<?php

namespace App\Services\SkuInDocument;

use App\Models\SkuByDocument;
use App\Services\Table\TableFilter;
use App\Services\Table\TableSort;

class TableFacade
{
    public static function getFilteredData()
    {

        $documents = SkuByDocument::with('goods')
            ->leftJoin('goods', 'goods_id', '=', 'goods.id')
            ->where('document_id', $_GET['document_id'])
            ->select('sku_by_documents.*', 'goods.name');

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);

        return $filter->filter([], $documents);
    }
}
