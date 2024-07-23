<?php

namespace App\Http\Resources\Match;

use Illuminate\Http\Resources\Json\JsonResource;

class LogistConsolidationInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [];

        $consolidation = $this;
        $goodsInvoiceArray = $consolidation->goodsInvoices;


        $sortedRoutes = $this->prematchService->getRoutesByPlanningAndTN($transportPlanning, $goodsInvoiceArray);

        return $data;
    }
}
