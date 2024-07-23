<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function store(Request $request)
    {
        $integrationId = Integration::store($request);

        return response()->json(['integration_id' => $integrationId]);
    }

    public function update(Request $request, Integration $integration)
    {
        $integration->fill($request->except(['_token']));
        $integration->save();

        return response()->json(['integration_id' => $integration->id]);
    }

    public function destroy(Integration $integration)
    {
        $integration->delete();

        return response()->json([], 201);
    }
}
