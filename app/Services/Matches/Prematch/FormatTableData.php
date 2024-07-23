<?php

namespace App\Services\Matches\Prematch;

use App\Http\Resources\TableCollectionResource;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use App\Services\Table\AbstractFormatTableData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($consolidations)
    {
        $returnArray = [];

        foreach ($consolidations as $i => $consolidation) {
            $pallets = 0;
            $weight = 0;
            $transportPlanning = $consolidation->transportPlanning[0];
            $transportPlanningType = $transportPlanning->documents[0]->documentType->key;
            $fields = $transportPlanning->getFieldsByType($transportPlanningType);

            $documentsCount = count($transportPlanning->documents);
            $startPoint = Warehouse::find($transportPlanning->documents[0]
                ->data()['header_ids'][$fields['loadingWarehouseField'] . '_id']);
            $endPoint = Warehouse::find($transportPlanning->documents[$documentsCount - 1]
                ->data()['header_ids'][$fields['unloadingWarehouseField'] . '_id']);

            $returnArray['id'] = $consolidation->id;
            $returnArray['created'] = Carbon::parse($consolidation->created_at)->format('d.m.Y H:i');
            $returnArray['members'] = $consolidation->members;
            if ($startPoint) {
                $returnArray['shippingPoint'] = $startPoint->address?->settlement?->name ?? $startPoint->name;
            }

            if ($endPoint) {
                $returnArray['deliveryPoint'] = $endPoint->address?->settlement?->name ?? $endPoint->name;
            }

            foreach ($transportPlanning->documents as $document) {
                $goods = $document->goods;
                foreach ($goods as $item) {
                    $pallets += (int)json_decode($item->getOriginal('pivot_data'),
                        true)['2text_field_2'];
                }
            }

            foreach ($consolidation->goodsInvoices as $document) {
                $goods = $document->goods;
                foreach ($goods as $item) {
                    $pallets += (int)json_decode($item->getOriginal('pivot_data'),
                        true)['2text_field_2'];
                }
            }

            $returnArray['pallets'] = $pallets;
            $returnArray['status'] = $consolidation->status;
        }

        return TableCollectionResource::make($returnArray)->setTotal($consolidations->total());
    }

}
