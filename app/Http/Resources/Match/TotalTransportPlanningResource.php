<?php

namespace App\Http\Resources\Match;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalTransportPlanningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data['pallet_count'] = 0;
        $weight = 0;
        $members = [];

        $documents = $this->documents;

        foreach ($documents as $document) {
            $goods = $document->goods;

            $members[] = $document->data()['header']['1select_field_1'];

            foreach ($goods as $item) {
                //TODO Розібратись з пакуванням
                $weight += $item->packages[0]->weight * $item->getOriginal('pivot_count');
                $data['pallet_count'] += (int)json_decode($item->getOriginal('pivot_data'),
                    true)['1text_field_1'];
            }
        }

        $data['weight'] = round($weight);
        $data['members'] = $members;
        $data['common_count'] = $this->transport->capacity_eu
            ?? $this->transport->equipment?->capacity_eu;
        $data['common_weight'] = (int)$this->transport->carrying_capacity
            ?? (int)$this->transport->equipment?->carrying_capacity;

        return $data;
    }
}
