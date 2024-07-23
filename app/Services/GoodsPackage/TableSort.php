<?php

namespace App\Services\GoodsPackage;

use App\Services\Table\AbstractTableSort;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($_GET['sortdatafield'] == 'type') {
                $model = $model
                    ->leftJoin('package_types', 'packages.type_id', '=', 'package_types.id')
                    ->orderBy('package_types.name', $sortOrder);
            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }

        }
        return $model;
    }
}
