<?php

namespace App\Services\AdditionalEquipment;

use App\Services\Table\AbstractTableSort;
use Illuminate\Support\Facades\DB;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($_GET['sortdatafield'] == 'model') {
                $model = $model
                    ->orderBy($sortDataField, $sortOrder)
                    ->select('*');

            } else if ($_GET['sortdatafield'] == 'dnz') {
                $model = $model->orderBy('license_plate', $sortOrder);

            } else if ($_GET['sortdatafield'] == 'company') {
                $model = $model
                   ->orderBy('company_with_details.name', $sortOrder);

            } else if ($_GET['sortdatafield'] == 'typeLoad') {
                $model = $model
                    ->orderBy('methods.new_download_methods', $sortOrder);

            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }
        }
        return $model;
    }
}
