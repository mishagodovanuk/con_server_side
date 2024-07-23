<?php

namespace App\Services\Service;

use App\Services\Table\AbstractTableSort;
use Illuminate\Support\Facades\DB;

class TableSort extends AbstractTableSort
{
    public function getSortedData($model)
    {
        if (isset($_GET['sortdatafield']) && $_GET['sortorder'] != '') {
            $sortDataField = $this->formatTableData->renameFields($_GET['sortdatafield']);
            $sortOrder = $_GET['sortorder'];

            if ($sortDataField == 'category') {
                $model = $model
                    ->leftJoin('service_categories', 'services.category_id', '=', 'service_categories.id')
                    ->select(['services.*', DB::raw('service_categories.name as category_name')])
                    ->orderBy('category_name', $sortOrder);
            } else {
                $model = $model->orderBy($sortDataField, $sortOrder);
            }
        }
        return $model;
    }
}
