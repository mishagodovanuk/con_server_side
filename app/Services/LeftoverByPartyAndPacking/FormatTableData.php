<?php

namespace App\Services\LeftoverByPartyAndPacking;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($leftovers)
    {
        $leftoversArr = [];
        for ($i = 0; $i < count($leftovers); $i++) {
            $leftoversArr[] = $leftovers[$i]->toArray();
            $leftoversArr[$i]['sku'] = $leftovers[$i]->goods->name;
            $leftoversArr[$i]['packaging'] = $leftovers[$i]->packages->first()->name;
        }

        return TableCollectionResource::make(array_values($leftoversArr))->setTotal($leftovers->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'sku') {
            $fieldName = DB::raw("goods.name");
        } else if ($fieldName == 'party') {
            $fieldName = DB::raw('goods.party');
        } else if ($fieldName == 'packaging') {
            $fieldName = DB::raw('packages.name');
        }

        return $fieldName;
    }
}
