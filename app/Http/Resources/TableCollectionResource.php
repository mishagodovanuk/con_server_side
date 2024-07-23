<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TableCollectionResource extends ResourceCollection
{
    protected $totalRecords;

    public function setTotal($totalRecords){
        $this->totalRecords = $totalRecords;
        return $this;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'total' => $this->totalRecords,
        ];
    }
}
