<?php

namespace App\Services\GoodsBarcode;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($barcodes)
    {
        $barcodesArr = [];
        for ($i = 0; $i < count($barcodes); $i++) {
            $barcodesArr[] = $barcodes[$i]->toArray();
        }

        return TableCollectionResource::make(array_values($barcodesArr))->setTotal($barcodes->total());
    }
}
