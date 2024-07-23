<?php

namespace App\Services\TransportPlaning;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($transportPlannings)
    {
        $transportPlanningsArr = [];
        for ($i = 0; $i < count($transportPlannings); $i++) {
            $transportPlanningsArr[$i]['data'] = $transportPlannings[$i]->date;
            $transportPlanningsArr[$i]['day'] = $transportPlannings[$i]->weekday;
            $transportPlanningsArr[$i]['countAuto'] = $transportPlannings[$i]->tp_count;
            $transportPlanningsArr[$i]['initialization'] = $transportPlannings[$i]->tp_count;
            $transportPlanningsArr[$i]['delete'] = $transportPlannings[$i]->tp_count;
        }

        return TableCollectionResource::make(array_values($transportPlanningsArr))->setTotal($transportPlannings->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'data') {
            $fieldName = DB::raw("(CASE WHEN CURRENT_DATE() > DATE_FORMAT(download_start, '%Y-%m-%d') THEN DATE_FORMAT(unloading_start, '%Y-%m-%d') ELSE DATE_FORMAT(download_start, '%Y-%m-%d') END)");
        } else if ($fieldName == 'day') {
            $fieldName = DB::raw("ANY_VALUE((CASE DATE_FORMAT((CASE WHEN CURRENT_DATE() > DATE_FORMAT(download_start, '%Y-%m-%d') THEN DATE_FORMAT(unloading_start, '%Y-%m-%d') ELSE DATE_FORMAT(download_start, '%Y-%m-%d') END), '%w') WHEN 0 THEN 'Неділя' WHEN 1 THEN 'Понеділок' WHEN 2 THEN 'Вівторок' WHEN 3 THEN 'Середа' WHEN 4 THEN 'Четвер' WHEN 5 THEN 'П\'ятниця' WHEN 6 THEN 'Субота' END))");
        }

        return $fieldName;
    }
}
