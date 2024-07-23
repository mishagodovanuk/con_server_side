<?php

namespace App\Services\TransportRequest;

use App\Http\Resources\TableCollectionResource;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{

    private array $dataFields;



    public function __construct()
    {
        $this->dataFields = (new TransportPlanning())->getFieldsByType('zapyt_na_transport');
    }
    public function formatData($documents)
    {
        $documentsArr = [];
        for ($i = 0; $i < count($documents); $i++) {
            $documentsArr[] = [];

            $docData = $documents[$i]->allBlocksToArray();


            $documentsArr[$i]['id'] = $documents[$i]->id;

            $documentsArr[$i]['loading'] = [
                'company' => $docData[$this->dataFields['companyProviderField']],
                'location' => $docData[$this->dataFields['loadingWarehouseField']],
                'date' => $docData[$this->dataFields['loadingDate']][0],
                'start_at' => $docData[$this->dataFields['loadingDate']][1],
                'end_at' => $docData[$this->dataFields['loadingDate']][2]
            ];

            $documentsArr[$i]['unloading'] = [
                'company' => $docData[$this->dataFields['companyCustomerField']],
                'location' => $docData[$this->dataFields['unloadingWarehouseField']],
                'date' => $docData[$this->dataFields['unloadingDate']][0],
                'start_at' => $docData[$this->dataFields['unloadingDate']][1],
                'end_at' => $docData[$this->dataFields['unloadingDate']][2]
            ];

            $documentsArr[$i]['pallet'] = $docData[$this->dataFields['pallet']] ;
            $documentsArr[$i]['weight'] = $docData[$this->dataFields['weight']] ;

        }

        return TableCollectionResource::make(array_values($documentsArr))->setTotal($documents->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'type') {
            $fieldName = DB::raw("documents.id");
        } else if ($fieldName == 'loading') {
            $fieldName = DB::raw("CONCAT(JSON_EXTRACT(data, '$.header."
                . $this->dataFields['companyProviderField'] . "'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['loadingWarehouseField'] . "'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['loadingDate'] . "[0]'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['loadingDate'] . "[1]'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['loadingDate'] . "[2]'))");
        } else if ($fieldName == 'unloading') {
            $fieldName = DB::raw("CONCAT(JSON_EXTRACT(data, '$.header."
                . $this->dataFields['companyCustomerField'] . "'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['unloadingWarehouseField'] . "'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['unloadingDate'] . "[0]'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['unloadingDate']. "[1]'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['unloadingDate'] . "[2]'))");
        }

        return $fieldName;
    }
}
