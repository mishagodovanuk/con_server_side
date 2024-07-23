<?php

namespace App\Services\GoodsInvoices;

use App\Http\Resources\TableCollectionResource;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use App\Services\Table\AbstractFormatTableData;
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
        $documentsArr = [];
        for ($i = 0; $i < count($documents); $i++) {
            $documentsArr[] = $documents[$i]->toArray();

            $docData = json_decode($documents[$i]->data, true);
            $docHeader = $docData['header'];

            $documentsArr[$i]['type'] = "№ {$documents[$i]->id}";
            $documentsArr[$i]['loading'] = "{$docHeader[$this->dataFields['companyProviderField']]}
             {$docHeader[$this->dataFields['loadingWarehouseField']]} {$docHeader[$this->dataFields['loadingDate']][0]}
              {$docHeader[$this->dataFields['loadingDate']][1]} {$docHeader[$this->dataFields['loadingDate']][2]}";
            $documentsArr[$i]['unloading'] = "{$docHeader[$this->dataFields['companyCustomerField']]}
            {$docHeader[$this->dataFields['unloadingWarehouseField']]} {$docHeader[$this->dataFields['unloadingDate']][0]}
            {$docHeader[$this->dataFields['unloadingDate']][1]} {$docHeader[$this->dataFields['unloadingDate']][2]}";

            $weight = 0;
            $pallet = 0;

            if ($documents[$i]->goods->count()) {
                $documents[$i]->goods->each(function ($item) use (&$weight, &$pallet) {
                    $weight += $item->weight_brutto * $item->pivot->count;
                    if ($item->packages->count()) {
                        $weight += $item->packages->first()->weight_brutto;
                        $pallet += intval(ceil($item->pivot->count / $item->packages->first()->number));
                    }
                });
            }

            $warehouses = Warehouse::currentWorkspace()->joinAddress()->get(['warehouses.id', 'full_address']);

            $loadingWarehouseId = $docData['header_ids'][$this->dataFields['loadingWarehouseField'] . '_id'];
            $unloadingWarehouseId = $docData['header_ids'][$this->dataFields['unloadingWarehouseField'] . '_id'];

            $documentsArr[$i]['goods'] = "Вага: {$weight} Палет: {$pallet}";
            $documentsArr[$i]['weight'] = $weight;
            $documentsArr[$i]['pallet'] = $pallet;
            $documentsArr[$i]['loading_info'] = [
                'warehouse' => $docHeader[$this->dataFields['loadingWarehouseField']],
                'date' => $docHeader[$this->dataFields['loadingDate']][0],
                'start_at' => $docHeader[$this->dataFields['loadingDate']][1],
                'end_at' => $docHeader[$this->dataFields['loadingDate']][2],
                'address' => $warehouses->where('id', $loadingWarehouseId)->first()->full_address
            ];
            $documentsArr[$i]['unloaidng_info'] = [
                'warehouse' => $docHeader[$this->dataFields['unloadingWarehouseField']],
                'date' => $docHeader[$this->dataFields['unloadingDate']][0],
                'start_at' => $docHeader[$this->dataFields['unloadingDate']][1],
                'end_at' => $docHeader[$this->dataFields['unloadingDate']][2],
                'address' => $warehouses->where('id', $unloadingWarehouseId)->first()->full_address
            ];
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
                . $this->dataFields['unloadingDate'] . "[1]'), ' ', JSON_EXTRACT(data, '$.header."
                . $this->dataFields['unloadingDate'] . "[2]'))");
        }

        return $fieldName;
    }
}
