<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use App\Http\Requests\Match\PrematchRequest;
use App\Http\Resources\Match\ConsolidationDataResource;
use App\Models\Document;
use App\Models\Match\Consolidation;
use App\Models\TransportPlanning;
use App\Services\Matches\Prematch\TableFacade as MatchTableFacade;
use App\Services\Matches\Repository\ConsolidationRouteService;
use App\Services\Matches\Repository\PrematchService;
use GuzzleHttp\Psr7\Request;


class MatchController extends Controller
{
    public function __construct(private ConsolidationRouteService $routeService, private PrematchService $prematchService)
    {}

    public function store(PrematchRequest $request)
    {
        return $this->prematchService->store($request->validated());
    }

    public function getRouteByPlanning(TransportPlanning $transportPlanning)
    {
        $documentsArray = $_GET['goods_invoices'] ?? $_GET['transport_requests'];
        return $this->routeService->getRoutesByPlanningAndTN($transportPlanning, $documentsArray);
    }


    public function show(Consolidation $consolidation)
    {
        return ConsolidationDataResource::make($consolidation);
    }

    public function destroy(Consolidation $consolidation)
    {
        $consolidation->transportPlanning()->first()
            ->update(['is_reserved'=>0]);
        $consolidation->delete();

        return response('OK');
    }

    public function returnToWork(Request $request,Consolidation $consolidation)
    {
        $consolidation->update([
            'status' => 'sent'
        ]);

        return response('OK');
    }

    public function edit(Consolidation $consolidation)
    {
        dd("Not ready");
    }

    public function update(Request $request, Consolidation $consolidation)
    {

    }

    public function matchFilter()
    {
        return MatchTableFacade::getFilteredData();
    }
}
