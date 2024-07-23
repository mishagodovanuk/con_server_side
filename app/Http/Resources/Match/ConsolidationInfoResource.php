<?php

namespace App\Http\Resources\Match;

use App\Models\TransportPlanning;
use App\Services\Matches\Repository\ConsolidationRouteService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsolidationInfoResource extends JsonResource
{

    private $routeService;

    private array $dataFields;

    public function __construct($resource)
    {
        $this->dataFields = (new TransportPlanning())->getFieldsByType('tovarna_nakladna');
        $this->routeService = new ConsolidationRouteService();
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

        $transportPlanning = $this;

        $consolidation = $transportPlanning->consolidation[0];

        $documents = $request->transportPlanning->documents;

        $cargoTypeKeys = [];
        $cargoTypeIDs = [];
        $downloadPoints = [];
        $uploadPoints = [];
        $goodsInvoiceArray = $consolidation->goodsInvoices;


        $sortedRoutes = $this->routeService->getRoutesByPlanningAndTN($transportPlanning, $goodsInvoiceArray);

        foreach ($sortedRoutes as $sortedRoute) {
            if ($sortedRoute['type'] == 'upload') {
                $uploadPoints[] = $sortedRoute['warehouse_address'];
            } else {
                $downloadPoints[] = $sortedRoute['warehouse_address'];
            }
        }
        foreach ($documents as $document) {
            $goods = $document->goods;
            foreach ($goods as $item) {
                if (!in_array($item->cargo_type->key, $cargoTypeKeys)) {
                    $cargoTypeKeys[] = $item->cargo_type->key;
                    $cargoTypeIDs[] = $item->cargo_type->id;
                }
            }
        }

        $data = [
            'consolidation_id' => $consolidation->id,
            'transport_planning' => $transportPlanning->id,
            'created_at' => Carbon::parse($transportPlanning->created_at)->format('d.m.Y H:i'),
            'status' => $consolidation->status,
            'type' => $consolidation->type,
            'route' => $sortedRoutes[0]['warehouse_city_or_name'] . ' - ' . $sortedRoutes[count($sortedRoutes) - 1]['warehouse_city_or_name'],
            'download_time' => $this->generateTimeRange($this->dataFields['loadingDate'], $documents[0]),
            'upload_time' => $this->generateTimeRange($this->dataFields['unloadingDate'], $documents[count($documents) - 1]),
            'members' => $consolidation->members,
            'download_points' => count(array_unique($downloadPoints)),
            'upload_points' => count(array_unique($uploadPoints)),
            'cargo_type' => $cargoTypeKeys,
            'cargo_type_ids' => $cargoTypeIDs,
            'pallets' => $consolidation->pallets_booked,
            'common_pallets' => $consolidation->pallets_available,
            'weight' => $consolidation->weight_booked,
            'common_weight' => $consolidation->weight_available,
            'comment' => $consolidation->comment,

        ];


        return $data;
    }

    private function generateTimeRange(string $field, $document): string
    {
        return $document->data()['header'][$field][0] . ' ' .
            $document->data()['header'][$field][1] . '-' .
            $document->data()['header'][$field][2];
    }


}
