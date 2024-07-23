<?php

namespace App\Services\Matches\Upload\TP;

use App\Services\Table\AbstractTableSort;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($sortDataField == 'date') {
                $model = $model->orderBy('download_start', $sortOrder);
            } elseif ($sortDataField == 'day') {
                $model = $model->orderBy("DATE_FORMAT(download_start, '%W')", $sortOrder);
            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }
        }
        return $model;
    }
}
