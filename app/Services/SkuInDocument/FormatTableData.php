<?php

namespace App\Services\SkuInDocument;

use App\Http\Resources\TableCollectionResource;
use App\Services\Document\TableFields;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($sku)
    {
        $formatedArray = [];
        for ($i = 0; $i < count($sku); $i++) {
            $formatedArray[] = $sku[$i]->toArray();
            $formatedArray[$i]['name'] = $sku[$i]->goods->name;
            foreach (json_decode($formatedArray[$i]['data'], true) as $key => $value) {
                $formatedArray[$i]['data->'.$key] = TableFields::getFormattedField($key,$value);
            };
        }

        return TableCollectionResource::make(array_values($formatedArray))->setTotal($sku->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'name') {
            $fieldName = DB::raw("goods.name");
        }else if($fieldName == 'id'){
            $fieldName = DB::raw('sku_by_documents.id');
        }

        return $fieldName;
    }

}
