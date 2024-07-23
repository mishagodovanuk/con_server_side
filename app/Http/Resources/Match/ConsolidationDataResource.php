<?php

namespace App\Http\Resources\Match;

use App\Models\Warehouse;
use App\Services\Matches\Repository\PrematchService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsolidationDataResource extends JsonResource
{

    private $prematchService;

    public function __construct($resource)
    {
        $this->prematchService = new PrematchService();
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $consolidation = $request->consolidation;
        $transportPlanning = $consolidation->transportPlanning[0];
        $transportPlanningType = $transportPlanning->documents[0]->documentType->key;
        $members = [];
        $pallets = 0;
        $weight = 0;
        $downloadPoints = [];
        $uploadPoints = [];
        $cargoTypes = [];

        $fields = $transportPlanning->getFieldsByType($transportPlanningType);

        $documentsCount = count($transportPlanning->documents);

        $startPoint = Warehouse::find($transportPlanning->documents[0]
            ->data()['header_ids'][$fields['loadingWarehouseField'] . '_id']);
        $endPoint = Warehouse::find($transportPlanning->documents[$documentsCount - 1]
            ->data()['header_ids'][$fields['unloadingWarehouseField'] . '_id']);

        $this->processDocuments($transportPlanning->documents, $members,
            $downloadPoints, $uploadPoints,$cargoTypes, $weight, $pallets, $fields);

        $this->processDocuments($consolidation->goodsInvoices, $members,
            $downloadPoints,$uploadPoints, $cargoTypes, $weight, $pallets, $fields);

        return [
            'status' => $consolidation->status,
            'created' => Carbon::parse($consolidation->created_at)->format('d.m.Y H:i'),
            'created_by' => [
                'id' => $consolidation->user->id,
                'image_link' => $consolidation->user->avatar_type ? '/file/uploads/user/avatars/'.$consolidation->user->id.'.'.$consolidation->user->avatar_type
                    : asset('assets/images/avatar_empty.png'),
                'name' => $consolidation->user->name . ' ' . $consolidation->user->surname
            ],
            'pallets' => $pallets,
            'capacity_pallets' => $transportPlanning->transport->capacity_eu
                ?? $transportPlanning->transport->equipment?->capacity_eu,
            'consolidation_type' => $consolidation->type,
            'route' => ($startPoint->address?->settlement?->name ?? $startPoint->name)
                . ' - ' . ($endPoint->address?->settlement?->name ?? $endPoint->name),
            'trip_duration' => Carbon::parse($transportPlanning->documents[0]->data()['header'][$fields['loadingDate']][0])
                    ->format('d.m.Y') .
                ' - ' . Carbon::parse($transportPlanning->documents[$documentsCount-1]->data()['header'][$fields['loadingDate']
                ][0])->format('d.m.Y'),
            'members' => $this->uniqueValuesByKey($members, 'id'),
            'download_point_count' => count(array_unique($downloadPoints)),
            'unload_point_count' => count(array_unique($uploadPoints)),
            'weight' => $weight,
            'common_weight' => $transportPlanning->transport?->carrying_capacity ?
                $transportPlanning->transport?->carrying_capacity * 1000 :
                $transportPlanning->additional_equipment?->carrying_capacity * 1000,
            'cargo_types' => $cargoTypes,
            'comment' => $consolidation->comment,
            'routeInfo' => $this->prematchService->getRoutesByPlanningAndTN($transportPlanning,$transportPlanning->documents->pluck('id')->toArray())
        ];
    }

    private function generateEntityData($document, string $field): array
    {
        return [
            'id' => $document->data()['header_ids'][$field . '_id'],
            'name' => $document->data()['header'][$field],
        ];
    }

    private function uniqueValuesByKey($array, $key)
    {
        $tempArray = [];
        $result = [];

        foreach ($array as $item) {
            // Check if the value for the specified key already exists in $tempArray
            if (!isset($tempArray[$item[$key]])) {
                $tempArray[$item[$key]] = true;
                $result[] = $item;
            }
        }

        return $result;
    }


    private function processDocuments($documents, &$members, &$downloadPoints,&$uploadPoints, &$cargoTypes, &$weight, &$pallets, $fields) {
        foreach ($documents as $document) {
            $goods = $document->goods;
            $members[] = $this->generateEntityData($document, $fields['companyProviderField']);
            $downloadPoints[] = $document->data()['header'][$fields['loadingWarehouseField']];
            $uploadPoints[] = $document->data()['header'][$fields['unloadingWarehouseField']];
            foreach ($goods as $item) {
                if (!in_array($item->cargo_type->name, $cargoTypes)) {
                    $cargoTypes[] = $item->cargo_type->name;
                }
                $weight += $item->packages[0]->weight_brutto * (int)json_decode($item->getOriginal('pivot_data'), true)['1text_field_1'];
                $pallets += (int)json_decode($item->getOriginal('pivot_data'), true)['2text_field_2'];
            }
        }
    }
}
