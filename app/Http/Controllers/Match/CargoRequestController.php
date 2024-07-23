<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use App\Http\Resources\Match\CargoRequestInfoResource;
use App\Http\Resources\Match\ConsolidationInfoResource;
use App\Http\Resources\Match\TransportPlanningInfoResource;
use App\Models\Document;
use App\Models\TransportPlanning;
use App\Services\Matches\Repository\ConsolidationRouteService;
use App\Services\Matches\ReverseLoading\CargoRequest\TableFacade;
use App\Services\Matches\ReverseLoading\TransportPlanning\TableFacade as TransportPlanningFacade;

class CargoRequestController extends Controller
{
    public function __construct(private ConsolidationRouteService $routeService){}

    public function cargoRequestFilter()
    {
        return TableFacade::getFilteredData();
    }

    public function getRouteByCargoRequest(Document $cargoRequest)
    {
        $transportPlanningArray = $_GET['transport_plannings'];

        return $this->routeService->getRoutesByCargoRequest($cargoRequest,$transportPlanningArray);
    }

    public function getInfo(Document $document)
    {
        return new CargoRequestInfoResource($document);
    }

    public function transportPlanningFilter()
    {
        return TransportPlanningFacade::getFilteredData();
    }

    public function getTransportPlanningInfo(TransportPlanning $transportPlanning)
    {
        if (count($transportPlanning->consolidation)) {
            return new ConsolidationInfoResource($transportPlanning);
        }else{
            return new TransportPlanningInfoResource($transportPlanning);
        }
    }
}
