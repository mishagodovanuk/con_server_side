<?php

namespace App\Http\Resources\Match;

use App\Models\TransportPlanning;
use App\Models\Warehouse;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;


class GoodsInvoiceResource extends JsonResource
{
    private array $dataFields;

    private $totalTime = 0;

    public function __construct($resource)
    {
        $this->dataFields = (new TransportPlanning())->getFieldsByType('tovarna_nakladna');
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        $transportPlanning = TransportPlanning::with('documents')->find($request->input('transport_planning_id'));
        $transportPlanningDocuments = $transportPlanning->documents;

        $palletsCount = 0;
        $weight = 0;
        $categories = [];

        $cargoTypeIds = [];
        foreach ($this->goods as $item) {
            if (!in_array($item->cargo_type->id, $cargoTypeIds)) {
                $cargoTypeIds[] = $item->cargo_type->id;
            }
            $weight += $item->packages[0]->weight_brutto * $item->getOriginal('pivot_count');
            $palletsCount += (int)json_decode($item->getOriginal('pivot_data'),
                true)['1text_field_1'];
            $categories[$item->category->id] = $item->category->name;
        }

        //TODO актуалізувати дані
        $data = [
            'id' => $this->id,
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y H:i'),
            'status' => 'Підписано всіма',
            'contract_id' => '123456',
            'order_id' => '123123242',
            'price_3pl' => '7800',
            'company_provider' => $this->generateEntityData($this->dataFields['companyProviderField']),
            'company_recipient' => $this->generateEntityData($this->dataFields['companyCustomerField']),
            'location_provider' => $this->generateEntityData($this->dataFields['loadingWarehouseField']),
            'location_recipient' => $this->generateEntityData($this->dataFields['unloadingWarehouseField']),
            'download_time' => $this->generateTimeRange($this->dataFields['loadingDate']),
            'upload_time' => $this->generateTimeRange($this->dataFields['unloadingDate']),
            'comment' => $this->data()['header'][$this->dataFields['comment']],
            'weight' => round($weight),
            'palletsCount' => $palletsCount,
            'categories' => $categories,
            'cargoTypeIds' => $cargoTypeIds
        ];

        $data['route'] = [
            $this->generateRoute($transportPlanningDocuments[0], 'download'),
            $this->generateRoute($this, 'download', true),
            $this->generateRoute($this, 'upload', true),
            $this->generateRoute($transportPlanningDocuments[count($transportPlanningDocuments) - 1], 'upload')
        ];

        $data['total_time'] = $this->totalTime;

        return $data;
    }

    private function generateEntityData(string $field): array
    {
        return [
            'id' => $this->data()['header_ids'][$field . '_id'],
            'name' => $this->data()['header'][$field],
        ];
    }


    private function generateTimeRange(string $field): string
    {
        return $this->data()['header'][$field][0] . ' ' .
            $this->data()['header'][$field][1] . '-' .
            $this->data()['header'][$field][2];
    }

    private function generateRoute($document, $type, $withTime = false): array
    {

        $downloadOrUnloadDate = $type === 'download' ?
            $this->dataFields['loadingDate'] : $this->dataFields['unloadingDate'];
        $downloadOrUnloadWarehouseField = $type === 'download' ?
            $this->dataFields['loadingWarehouseField'] : $this->dataFields['unloadingWarehouseField'];

        $uploadTime1 = DateTime::createFromFormat('H:i', $document->data()['header'][$downloadOrUnloadDate][1]);
        $uploadTime2 = DateTime::createFromFormat('H:i', $document->data()['header'][$downloadOrUnloadDate][2]);
        $uploadTime = $uploadTime1->diff($uploadTime2);
        $time = $uploadTime->h * 60 + $uploadTime->i;

        $this->totalTime += $withTime ? $time : 0;

        $date = DateTime::createFromFormat('Y-m-d', $document->data()['header'][$downloadOrUnloadDate][0]);
        $startTime = $document->data()['header'][$this->dataFields['unloadingDate']][1];
        $endTime = $document->data()['header'][$this->dataFields['unloadingDate']][2];
        $uploadWarehouse = Warehouse::find($document->data()['header_ids'][$downloadOrUnloadWarehouseField . '_id']);

        return [
            'type' => $type,
            'time_from' => $document->data()['header'][$downloadOrUnloadDate][1],
            'time_to' => $document->data()['header'][$downloadOrUnloadDate][2],
            'time' => $time,
            "time_range" => $date->format('d.m.Y') . ' ' . $startTime . '-' . $endTime,
            'warehouse_city_or_name' => $uploadWarehouse->address->settlement?->name ?? $uploadWarehouse->name,
            'warehouse_address' => $this->generateWarehouseAddress($uploadWarehouse),
        ];
    }

    private function generateWarehouseAddress(Warehouse $warehouse): string
    {
        return $warehouse->address->settlement?->name ?
            $warehouse->address()->addFullAddress()->first()->full_address : $warehouse->address->comment;
    }
}
