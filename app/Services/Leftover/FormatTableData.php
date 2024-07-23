<?php

namespace App\Services\Leftover;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($leftovers)
    {
        $leftoversArr = [];
        $newLeftovers = collect();

        $leftovers->each(function ($item) use (&$newLeftovers) {
            $newItem = $newLeftovers->where('id', $item->id)->first();

            if (!is_null($newItem)) {

                //update all count, fill warehouse data
                $newItem['count'] += $item->count;
                $newItem['warehouses'] = array_merge($newItem['warehouses'], [[
                    'warehouse_name' => $item->warehouse_name,
                    'count' => $item->count,
                ]]);

                //update current item
                $newLeftovers->map(function ($item) use ($newItem) {
                    if ($item->id === $newItem->id) {
                        return $newItem;
                    }

                    return $item;
                });
            } else {
                $item['warehouses'] = [[
                    'warehouse_name' => $item->warehouse_name,
                    'count' => $item->count,
                ]];
                $newLeftovers->push($item);
            }
        });

        for ($i = 0; $i < count($newLeftovers); $i++) {
            $leftoversArr[] = $newLeftovers[$i]->toArray();
        }

        return TableCollectionResource::make(array_values($leftoversArr))->setTotal($newLeftovers->count());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'sku') {
            return DB::raw('goods.name');
        }

        return $fieldName;
    }
}
