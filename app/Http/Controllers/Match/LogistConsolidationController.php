<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use App\Http\Resources\Match\LogistConsolidationInfoResource;
use App\Models\Match\Consolidation;

class LogistConsolidationController extends Controller
{
    public function reject()
    {

    }

    public function getConsolidationInfo(Consolidation $consolidation)
    {
        return new LogistConsolidationInfoResource($consolidation);
    }

}
