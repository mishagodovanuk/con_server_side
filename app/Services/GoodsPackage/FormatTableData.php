<?php

namespace App\Services\GoodsPackage;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($packages)
    {
        $packagesArr = [];
        for ($i = 0; $i < count($packages); $i++) {
            $packagesArr[] = $packages[$i]->toArray();
            $packagesArr[$i]['type'] = $packages[$i]->type->name;
            $packagesArr[$i]['count'] = $packages[$i]->number;
            $packagesArr[$i]['packingWeight'] = $packages[$i]->weight;
            $packagesArr[$i]['weightNet'] = $packages[$i]->weight_netto;
            $packagesArr[$i]['weightGross'] = $packages[$i]->weight_brutto;
            $packagesArr[$i]['packingSetMain'] = $packages[$i]->is_default;
            $packagesArr[$i]['size'] = [
                'height' => $packages[$i]->height,
                'width' => $packages[$i]->width,
                'length' => $packages[$i]->depth
            ];
        }

        return TableCollectionResource::make(array_values($packagesArr))->setTotal($packages->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'count') {
            $fieldName = DB::raw("packages.number");
        } else if ($fieldName == 'packingWeight') {
            $fieldName = DB::raw("packages.weight");
        } else if ($fieldName == 'weightNet') {
            $fieldName = DB::raw("packages.weight_netto");
        } else if ($fieldName == 'weightGross') {
            $fieldName = DB::raw("packages.weight_brutto");
        } else if ($fieldName == 'size') {
            $fieldName = DB::raw("CONCAT(packages.height, ' ', packages.width, ' ', packages.depth)");
        }

        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

        if ($relationName == 'type') {
            $select = "package_types.name";
        }

        return $select;
    }
}
