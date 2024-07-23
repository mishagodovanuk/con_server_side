<?php

namespace App\Services\LeftoverByPartyAndPacking;

use App\Services\Table\AbstractTableSort;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($sortDataField == 'name') {
                $model = $model->orderBy('goods.name', $sortOrder);
            } else if ($sortDataField == 'party') {
                $model = $model->orderBy('goods.party', $sortOrder);
            } else if ($sortDataField == 'package') {
                $model = $model->orderBy('packages.name', $sortOrder);
            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }
        }
        return $model;
    }
}
