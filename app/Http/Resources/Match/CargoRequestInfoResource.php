<?php

namespace App\Http\Resources\Match;

use App\Models\Transport;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CargoRequestInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => [
                'name' => $this->data()['header']['1select_field_1'],
                'id' => $this->data()['header_ids']['1select_field_1_id']
            ],
            'transport' => [
                'name' => $this->data()['header']['3select_field_3'],
                'id' => $this->data()['header_ids']['3select_field_3_id']
            ],
            'additional_equipment' => [
                'name' => $this->data()['header']['4select_field_4'],
                'id' => $this->data()['header_ids']['4select_field_4_id']
            ],
            'driver' => [
                'name' => $this->data()['header']['5select_field_5'],
                'id' => $this->data()['header_ids']['5select_field_5_id']
            ],
            'auto_capacity' => $this->data()['custom_blocks'][1]['17text_field_17'],
            'max_cargo_price' => $this->data()['custom_blocks'][1]['18text_field_18'],
            'cargo_type' => $this->data()['custom_blocks'][1]['16label_field_16'],
            'weight' => $this->data()['custom_blocks'][1]['19text_field_19'],
            'route' => [
                [
                    'type' => 'download',
                    'city' => $this->data()['custom_blocks'][0]['6select_field_6'],
                    'radius' => $this->data()['custom_blocks'][0]['12text_field_12'],
                    'date' => Carbon::parse($this->data()['custom_blocks'][0]['10dateTimeRange_field_10'][0])
                            ->format('d.m.Y') . ' ' . $this->data()['custom_blocks'][0]['10dateTimeRange_field_10'][1]
                        . '-' . $this->data()['custom_blocks'][0]['10dateTimeRange_field_10'][2],
                    'max_points' => $this->data()['custom_blocks'][0]['8text_field_8']
                ],
                [
                    'type' => 'upload',
                    'city' => $this->data()['custom_blocks'][0]['7select_field_7'],
                    'radius' => $this->data()['custom_blocks'][0]['13text_field_13'],
                    'date' => Carbon::parse($this->data()['custom_blocks'][0]['11dateTimeRange_field_11'][0])
                            ->format('d.m.Y') . ' ' . $this->data()['custom_blocks'][0]['11dateTimeRange_field_11'][1]
                        . '-' . $this->data()['custom_blocks'][0]['11dateTimeRange_field_11'][2],
                    'max_points' => $this->data()['custom_blocks'][0]['9text_field_9']
                ],
            ]
        ];
    }
}
