<?php

namespace App\Http\Resources\Match;

use App\Models\TransportPlanning;
use App\Models\Warehouse;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class TransportPlanningInfoResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $documents = $request->transportPlanning->documents;
        $dataFields = (new TransportPlanning())->getFieldsByType($documents[0]->documentType->key);
        $palletsCount = 0;
        $weight = 0;
        $cargoTypeIds = [];
        //TODO change weight
        foreach ($documents as $document) {
            $goods = $document->goods;
            foreach ($goods as $item) {
                if (!in_array($item->cargo_type->id, $cargoTypeIds)) {
                    $cargoTypeIds[] = $item->cargo_type->id;
                }
                $weight += $item->packages[0]->weight_brutto * $item->getOriginal('pivot_count');
                $palletsCount += (int)json_decode($item->getOriginal('pivot_data'),
                    true)['1text_field_1'];
            }
        }
        $data = [
            'transport_planning_id' => $request->transportPlanning->id,
            'company_supplier' => $request->transportPlanning->carrier()->select(['companies.id'])->addName()->first()->toArray(),
            'company_payer' => $request->transportPlanning->payer()->select(['companies.id'])->addName()->first()->toArray(),
            'download_warehouse' => [
                'id' => $request->transportPlanning->documents[0]->data()['header_ids'][$dataFields['loadingWarehouseField'] . '_id'],
                'name' => $request->transportPlanning->documents[0]->data()['header'][$dataFields['loadingWarehouseField']]
            ],
            'upload_warehouse' => [
                'id' => $request->transportPlanning->documents[0]->data()['header_ids'][$dataFields['unloadingWarehouseField'] . '_id'],
                'name' => $request->transportPlanning->documents[0]->data()['header'][$dataFields['unloadingWarehouseField']]
            ],
            'price' => $request->transportPlanning->price,
            'payer' => $request->transportPlanning->payer()->select('companies.id')->addName()->first(['id', 'name'])->toArray(),
            'updated_at' => $request->transportPlanning->updated_at->format('d.m.Y'),
            'created_at' => $request->transportPlanning->created_at->format('d.m.Y'),
            'provider' => $request->transportPlanning->provider()->select('companies.id')->addName()->first(['id', 'name'])->toArray(),
            'driver' => $request->transportPlanning->driver()->select('users.id')->addFullName()->first(['id', 'full_name'])->toArray(),
            'transport' => $request->transportPlanning->transport?->toArray(),
            'additional_equipment' => $request->transportPlanning->additional_equipment?->toArray(),
            'pallet_count' => $palletsCount,
            'common_count' => $request->transportPlanning->transport->capacity_eu ?? $request->transportPlanning->transport->equipment?->capacity_eu,
            'comment' => $request->transportPlanning->comment,
            'weight' => round($weight),
            'common_weight' => $request->transportPlanning->transport?->carrying_capacity ?
                $request->transportPlanning->transport?->carrying_capacity * 1000 :
                $request->transportPlanning->additional_equipment?->carrying_capacity * 1000,
            'cargoTypeIds' => $cargoTypeIds

        ];

        $data['route'] = [];
        foreach ($documents as $count => $document) {

            $documentType = $document->documentType->key;

            $tempDataFields = (new TransportPlanning())->getFieldsByType($documentType);

            $data['route'] = array_merge($data['route'], $this->generateRouteForDocument($document, $tempDataFields));

        }

        return $data;
    }

    private function generateRouteForDocument($document, $dataFields)
    {
        $documentDataArray = $document->allBlocksToArray();

        $downloadTime1 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$dataFields['loadingDate']][1]);
        $downloadTime2 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$dataFields['loadingDate']][2]);
        $downloadTime = $downloadTime1->diff($downloadTime2);
        $date = DateTime::createFromFormat('Y-m-d', $documentDataArray['header'][$dataFields['loadingDate']][0]);
        $startTime = $documentDataArray['header'][$dataFields['loadingDate']][1];
        $endTime = $documentDataArray['header'][$dataFields['loadingDate']][2];
        $downloadWarehouse = Warehouse::find($documentDataArray['header_ids'][$dataFields['loadingWarehouseField'] . '_id']);

        $data[] = [
            'type' => 'download',
            'time_from' => $documentDataArray['header'][$dataFields['loadingDate']][1],
            'time_to' => $documentDataArray['header'][$dataFields['loadingDate']][2],
            'time' => $downloadTime->h * 60 + $downloadTime->i,
            "time_range" => $date->format('d.m.Y') . ' ' . $startTime . '-' . $endTime,
            "warehouse_city_or_name" => $downloadWarehouse->address->settlement?->name ?? $downloadWarehouse->name,
            "warehouse_address" => $downloadWarehouse->address->settlement?->name ?
                $downloadWarehouse->address()->addFullAddress()->first()->full_address : $downloadWarehouse->address->comment
        ];

        $uploadTime1 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$dataFields['unloadingDate']][1]);
        $uploadTime2 = DateTime::createFromFormat('H:i', $documentDataArray['header'][$dataFields['unloadingDate']][2]);
        $uploadTime = $uploadTime1->diff($uploadTime2);
        $date = DateTime::createFromFormat('Y-m-d', $documentDataArray['header'][$dataFields['unloadingDate']][0]);
        $startTime = $documentDataArray['header'][$dataFields['unloadingDate']][1];
        $endTime = $documentDataArray['header'][$dataFields['unloadingDate']][2];
        $uploadWarehouse = Warehouse::find($documentDataArray['header_ids'][$dataFields['unloadingWarehouseField'] . '_id']);

        $data[] = [
            'type' => 'upload',
            'time_from' => $documentDataArray['header'][$dataFields['unloadingDate']][1],
            'time_to' => $documentDataArray['header'][$dataFields['unloadingDate']][2],
            'time' => $uploadTime->h * 60 + $uploadTime->i,
            "time_range" => $date->format('d.m.Y') . ' ' . $startTime . '-' . $endTime,
            "warehouse_city_or_name" => $uploadWarehouse->address->settlement?->name ?? $uploadWarehouse->name,
            "warehouse_address" => $uploadWarehouse->address->settlement?->name ?
                $uploadWarehouse->address()->addFullAddress()->first()->full_address : $uploadWarehouse->address->comment
        ];

        return $data;
    }

}
