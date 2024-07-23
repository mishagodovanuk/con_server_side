<?php

namespace App\Services\Registers;

use App\Services\Table\AbstractTableSort;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($sortDataField == 'storekeeper') {
                $model = $model->leftJoin('users', 'users.id', '=', 'registers.storekeeper_id')
                    ->orderBy('users.surname', $sortOrder)
                    ->select('users.*');
            } elseif ($sortDataField == 'manager') {
                $model = $model->leftJoin('users', 'users.id', '=', 'registers.manager_id')
                    ->orderBy('users.surname', $sortOrder)
                    ->select('users.*');
            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }
        }
        return $model;
    }
}
