<?php

namespace App\Services\GoodsBarcode;

use App\Services\Table\AbstractTableSort;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            $model = $model->orderBy($sortDataField, $sortOrder);
        }
        
        return $model;
    }
}
