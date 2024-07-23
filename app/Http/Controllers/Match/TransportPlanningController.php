<?php

namespace App\Http\Controllers\Match;

use App\Events\ReserveTransportPlanning;
use App\Events\UnreserveTransportPlanning;
use App\Http\Controllers\Controller;
use App\Http\Resources\Match\TotalTransportPlanningResource;
use App\Http\Resources\Match\TransportPlanningInfoResource;
use App\Models\TransportPlanning;
use App\Models\TransportPlanningDocument;
use App\Models\Warehouse;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransportPlanningController extends Controller
{
    public function reserve(Request $request)
    {
        $transportPlanning = TransportPlanning::find($request->id);
        $transportPlanning->update([
            'is_reserved' => 1
        ]);
        broadcast(new ReserveTransportPlanning($request->id));
        return response('OK');
    }

    public function unReserve(Request $request)
    {
        $transportPlanning = TransportPlanning::find($request->id);
        $transportPlanning->update([
            'is_reserved' => 0
        ]);
        broadcast(new UnreserveTransportPlanning($request->id));
        return response('OK');
    }


    public function getTransportPlanningInfo(TransportPlanning $transportPlanning)
    {
        return new TransportPlanningInfoResource($transportPlanning);
    }

    public function getTotal(TransportPlanning $transportPlanning)
    {
        return new TotalTransportPlanningResource($transportPlanning);
    }

}
