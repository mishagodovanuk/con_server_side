<?php

namespace App\Services\Matches\Upload\TP;

use App\Http\Resources\TableCollectionResource;
use App\Models\TransportPlanning;
use App\Models\TransportPlanningDocument;
use App\Models\Warehouse;
use App\Services\Table\AbstractFormatTableData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    private $dataFields;

    public function __construct()
    {
        $this->dataFields = (new TransportPlanning())->getFieldsByType('tovarna_nakladna');
    }

    public function formatData($transportPlannings)
    {
        $transportPlanningsArr = [];
        for ($i = 0; $i < count($transportPlannings); $i++) {

            $documents = $transportPlannings[$i]->documents;
            $tnCount = count($transportPlannings[$i]->documents);

            $locationFrom = Warehouse::find($transportPlannings[$i]->documents[0]
                ->data()['header_ids'][$this->dataFields['loadingWarehouseField'] . '_id']);
            $locationTo = Warehouse::find($transportPlannings[$i]->documents[$tnCount - 1]
                ->data()['header_ids'][$this->dataFields['unloadingWarehouseField'] . '_id']);


            $tpDocument = TransportPlanningDocument::where('transport_planing_id', $transportPlannings[$i]->id)->first();

            $palletsCount = 0;

            $cargoTypes = '';

            foreach ($documents as $document) {
                foreach ($document->goods as $item) {
                    if (!str_contains($cargoTypes, $item->cargo_type->name)) {
                        $cargoTypes .= $item->cargo_type->name . "\n";
                        $cargoTypeIds[] = $item->cargo_type->id;
                    }

                    $palletsCount += (int)json_decode($item->getOriginal('pivot_data'),
                        true)['1text_field_1'];
                }
            }

            $commonCount = ($transportPlannings[$i]->transport->capacity_eu ?? $transportPlannings[$i]->equipment?->capacity_eu) ??
                $transportPlannings[$i]->transport->equipment?->capacity_eu;

            $transportPlanningsArr[$i]['id'] = $transportPlannings[$i]->id;
            $transportPlanningsArr[$i]['palletsCount'] = $palletsCount;
            $transportPlanningsArr[$i]['commonCount'] = $commonCount;
            if ($locationFrom) {
                $transportPlanningsArr[$i]['shippingPoint'] = $locationFrom->address?->settlement?->name ?? $locationFrom->name;

            }
            if ($locationTo) {
                $transportPlanningsArr[$i]['deliveryPoint'] = $locationTo->address?->settlement?->name ?? $locationTo->name;
            }

            $transportPlanningsArr[$i]['cargoType'] = $cargoTypes;
            $transportPlanningsArr[$i]['cargoTypeIds'] = $cargoTypeIds;
            $transportPlanningsArr[$i]['dispatchDate'] = Carbon::parse($tpDocument->uploading_start)->format('d.m.Y');
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
