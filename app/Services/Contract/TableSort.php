<?php

namespace App\Services\Contract;

use App\Services\Table\AbstractTableSort;
use Illuminate\Support\Facades\DB;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($sortDataField == 'company') {
                $model = $model
                    ->orderBy('company_with_details.name', $sortOrder);

            } else if ($sortDataField == 'type') {
                $model = $model
                    ->orderBy('transport_types.name', $sortOrder);

            } else if ($sortDataField == 'category') {
                $model = $model
                    ->orderBy('transport_categories.name', $sortOrder);

            } else if ($_GET['sortdatafield'] == 'defaultDriver') {
                $model = $model
                    ->orderBy($sortDataField, $sortOrder);

            } else if ($sortDataField == 'licensePlate') {
                $model = $model->orderBy('license_plate', $sortOrder);

            } else if ($_GET['sortdatafield'] == 'model') {
                $model = $model
                    ->orderBy($sortDataField, $sortOrder);

            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }
        }
        return $model;
    }
}
