<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Leftover;
use App\Models\Warehouse;
use App\Services\Leftover\TableFacade as Filter;
use App\Services\LeftoverByParty\TableFacade as FilterByParty;
use App\Services\LeftoverByPartyAndPacking\TableFacade as FilterByPartyAndPackage;
use Illuminate\Http\Request;

class LeftoverController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::currentWorkspace()->get();
        $leftovers = Leftover::all();
        return view('leftovers.index', compact('warehouses', 'leftovers'));
    }

    public function filter(Request $request)
    {
        return Filter::getFilteredData($request->get('warehouses_ids'));
    }

    public function filterByParty(Request $request)
    {
        return FilterByParty::getFilteredData($request->get('warehouses_ids'));
    }

    public function filterByPartyAndPackage()
    {
        return FilterByPartyAndPackage::getFilteredData();
    }

    public function addByDocument(Request $request, Document $document)
    {
        if (!$document->goods->count()) {
            return response()->json([
                'message' => "До документу не прикріплено товарів для приходу"
            ])->setStatusCode(422);
        }

        $warehouseFieldName = '6select_field_6';

        $docData = json_decode($document->data, true);
        $warehouseId = intval($docData["header_ids"]["{$warehouseFieldName}_id"]);

        foreach ($document->goods as $goods) {
            Leftover::create([
                'goods_id' => $goods->id,
                'document_id' => $document->id,
                'count' => $goods->pivot->count,
                'consignment' => json_decode($goods->pivot->data, true)['5date_field_5'],
                'warehouse_id' => $warehouseId
            ]);
        }

        return response()->json(['message' => 'Add successful']);
    }

    public function removeByDocument(Request $request, Document $document)
    {
        if (!$document->goods->count()) {
            return response()->json([
                'message' => "До документу не прикріплено товарів для списання"
            ])->setStatusCode(422);
        }

        $warehouseFieldName = '2select_field_2';

        $docData = json_decode($document->data, true);

        $warehouseId = intval($docData["header_ids"]["{$warehouseFieldName}_id"]);
        $warehouseLeftovers = Leftover::where('warehouse_id', $warehouseId)->get();

        //check count of goods
        foreach ($document->goods as $goods) {
            $consignment = json_decode($goods->pivot->data, true)['3date_field_6'];
            if ($warehouseLeftovers->where('goods_id', $goods->id)->where('consignment', $consignment)->sum('count') < $goods->pivot->count) {
                return response()->json([
                    'message' => "Не вистачає товару {$goods->name} на складі для списання"
                ])->setStatusCode(422);
            }
        }

        foreach ($document->goods as $goods) {
            $consignment = json_decode($goods->pivot->data, true)['3date_field_6'];

            Leftover::create([
                'goods_id' => $goods->id,
                'document_id' => $document->id,
                'count' => -$goods->pivot->count,
                'consignment' => $consignment,
                'warehouse_id' => $warehouseId
            ]);
        }

        return response()->json(['message' => 'Remove successful']);
    }

    public function moveByDocument(Request $request, Document $document)
    {
        if (!$document->goods->count()) {
            return response()->json([
                'message' => "До документу не прикріплено товарів для переміщення"
            ])->setStatusCode(422);
        }

        $warehouseFromFieldName = '2select_field_2';
        $warehouseToFieldName = '3select_field_3';

        $docData = json_decode($document->data, true);

        $warehouseFromId = intval($docData["header_ids"]["{$warehouseFromFieldName}_id"]);
        $warehouseToId = intval($docData["header_ids"]["{$warehouseToFieldName}_id"]);

        $warehouseLeftovers = Leftover::where('warehouse_id', $warehouseFromId)->get();

        //check count of goods
        foreach ($document->goods as $goods) {
            $consignment = json_decode($goods->pivot->data, true)['6date_field_6'];
            if ($warehouseLeftovers->where('goods_id', $goods->id)->where('consignment', $consignment)->sum('count') < $goods->pivot->count) {
                return response()->json([
                    'message' => "Не вистачає товару {$goods->name} на складі для переміщення"
                ])->setStatusCode(422);
            }
        }

        foreach ($document->goods as $goods) {
            $consignment = json_decode($goods->pivot->data, true)['6date_field_6'];

            Leftover::create([
                'goods_id' => $goods->id,
                'document_id' => $document->id,
                'count' => -$goods->pivot->count,
                'consignment' => $consignment,
                'warehouse_id' => $warehouseFromId
            ]);
            Leftover::create([
                'goods_id' => $goods->id,
                'document_id' => $document->id,
                'count' => $goods->pivot->count,
                'consignment' => $consignment,
                'warehouse_id' => $warehouseToId
            ]);
        }

        return response()->json(['message' => 'Move successful']);
    }
}
