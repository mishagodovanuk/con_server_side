<?php

namespace App\Services\Matches\Upload\TN;

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

        $warehouseIds = $documents->map(function ($item) {
            // Decode the JSON 'data' field
            $data = json_decode($item->data, true);
            return $data['header_ids'] ?? [];
        })->flatMap(function ($headerIds) {
            // Collect both '5select_field_5_id' and '6select_field_6_id' into a single collection
            return [
                $headerIds[$this->dataFields['loadingWarehouseField'] . '_id'] ?? null,
                $headerIds[$this->dataFields['unloadingWarehouseField'] . '_id'] ?? null
            ];
        })->filter()->all(); // Filter out null values and convert to array


        $warehouses = Warehouse::with(['address' => function ($query) {
            $query->addFullAddress();
        }])->whereIn('id', $warehouseIds)->get()->keyBy('id');

        $returnArray = [];
        foreach ($documents as $i => $document) {
            $docData = json_decode($document->data, true);
            $docHeader = $docData['header'];

            $supplierWarehouseAddress = $warehouses[$docData['header_ids'][$this->dataFields['loadingWarehouseField'] . '_id']] ?? null;
            $buyerWarehouse = $warehouses[$docData['header_ids'][$this->dataFields['unloadingWarehouseField'] . '_id']] ?? null;

            $returnArray[$i]['supplier'] = [
                'company' => $docHeader[$this->dataFields['companyProviderField']],
                'address' => $supplierWarehouseAddress->address->full_address ?? ''
            ];
            $returnArray[$i]['buyer'] = [
                'company' => $docHeader[$this->dataFields['companyCustomerField']],
                'address' => $buyerWarehouse->address->full_address ?? ''
            ];

            $pallet = 0;
            $cargoTypeIds = [];
            if ($documents[$i]->goods->count()) {
                $documents[$i]->goods->each(function ($item) use (&$weight, &$pallet, &$cargoTypeIds) {
                    $cargoTypeIds[] = $item->cargo_type->id;
                    $pallet += (int)json_decode($item->getOriginal('pivot_data'),
                        true)['1text_field_1'];

                });
            }

            $returnArray[$i]['pallet'] = $pallet;
            $returnArray[$i]['id'] = $documents[$i]->id;
            // Assuming $warehouses already contains 'full_address'
            $loadingWarehouseId = $docData['header_ids'][$this->dataFields['loadingWarehouseField'] . '_id'];
            $unloadingWarehouseId = $docData['header_ids'][$this->dataFields['unloadingWarehouseField'] . '_id'];

            $returnArray[$i]['loading_info'] = [
                'warehouse' => $docHeader[$this->dataFields['loadingWarehouseField']],
                'date' => $docHeader[$this->dataFields['loadingDate']][0],
                'start_at' => $docHeader[$this->dataFields['loadingDate']][1],
                'end_at' => $docHeader[$this->dataFields['loadingDate']][2],
                'address' => $warehouses->where('id', $loadingWarehouseId)->first()->full_address
            ];
            $returnArray[$i]['unloading_info'] = [
                'warehouse' => $docHeader[$this->dataFields['unloadingWarehouseField']],
                'date' => $docHeader[$this->dataFields['unloadingDate']][0],
                'start_at' => $docHeader[$this->dataFields['unloadingDate']][1],
                'end_at' => $docHeader[$this->dataFields['unloadingDate']][2],
                'address' => $warehouses->where('id', $unloadingWarehouseId)->first()->full_address
            ];

            $returnArray[$i]['cargoTypeIds'] = $cargoTypeIds;
        }

        return TableCollectionResource::make(array_values($returnArray))->setTotal($documents->total());
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
