<?php

namespace App\Services\Matches\Repository;

use App\Enums\Match\ConsolidationStatus;
use App\Helpers\GeocodingHelper;
use App\Models\Document;
use App\Models\Match\Consolidation;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrematchService
{
    public function store($data)
    {
        $consolidationArray = [
            'members' => $data['members'],
            'pallets_available' => $data['pallets_available'],
            'pallets_booked' => $data['pallets_booked'],
            'weight_available' => $data['weight_available'],
            'weight_booked' => $data['weight_booked'],
            'comment' => $data['comment'],
            'type' => $data['type'],
            'status' => array_key_exists('status', $data) ? $data['status'] : ConsolidationStatus::SENT,
            'user_id' => Auth::id()
        ];

        $consolidation = Consolidation::create($consolidationArray);

        $consolidation->cargoTypes()->attach($data['cargo_types']);


        if ($data['type'] == 'reverse_loading') {
            $consolidation->transportPlanning()->attach($data['transport_planning_ids']);
            $consolidation->cargoRequest()->attach($data['cargo_request_id']);
        } else {
            $consolidation->transportPlanning()->attach($data['transport_planning_id']);
            $goodsInvoiceToConsolidationData = [];

            foreach ($data['goods_invoices'] as $invoiceId) {
                $goodsInvoiceToConsolidationData[] = [
                    'goods_invoice_id' => $invoiceId,
                    'consolidation_id' => $consolidation->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            DB::table('goods_invoice_to_consolidations')->insert($goodsInvoiceToConsolidationData);
        }

        return ['id' => $consolidation->id];
    }
}
