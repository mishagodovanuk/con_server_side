<?php

namespace App\Services\Matches\ReverseLoading\CargoRequest;

use App\Http\Resources\TableCollectionResource;
use App\Models\TransportPlanning;
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

    public function formatData($documents)
    {
        $returnArray = [];
        foreach ($documents as $i => $document) {
            $returnArray[] = [
                'id' => $document->id,
                'download' => $document->data()['custom_blocks'][0]['6select_field_6'],
                'upload' => $document->data()['custom_blocks'][0]['7select_field_7'],
                'download_date' => Carbon::parse($document->data()['custom_blocks'][0]['10dateTimeRange_field_10'][0])
                    ->format('d.m.Y'),
                'download_time' => $document->data()['custom_blocks'][0]['10dateTimeRange_field_10'][1].'-'.$document->data()['custom_blocks'][0]['10dateTimeRange_field_10'][2],
                'upload_date' => Carbon::parse($document->data()['custom_blocks'][0]['11dateTimeRange_field_11'][0])
                    ->format('d.m.Y'),
                'upload_time' => $document->data()['custom_blocks'][0]['11dateTimeRange_field_11'][1].'-'.$document->data()['custom_blocks'][0]['11dateTimeRange_field_11'][2],
                'free_space_pallets' => $document->data()['custom_blocks'][1]['17text_field_17'],
                'free_space_weight' => $document->data()['custom_blocks'][1]['19text_field_19']
            ];
        }

        return TableCollectionResource::make(array_values($returnArray))->setTotal($documents->total());
    }

    public function renameFields($fieldName)
    {
        return $fieldName;
    }
}
