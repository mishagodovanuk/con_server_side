<?php

namespace App\Services\Document;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($documents)
    {
        $formatedArray = [];
        for ($i = 0; $i < count($documents); $i++) {

            $formatedArray[] = $documents[$i]->toArray();
            $formatedArray[$i]['type'] = $formatedArray[$i]['document_type']['name'];
            $formatedArray[$i]['status'] = $formatedArray[$i]['status']['name'];


            $formatedArray[$i] = array_merge($formatedArray[$i], TableFields::format($formatedArray[$i], 'header'));

            $customBlocks = json_decode($formatedArray[$i]['data'], true)['custom_blocks'];
            for ($j = 0; $j < count($customBlocks); $j++) {
                foreach ($customBlocks[$j] as $key => $value) {
                    $formatedArray[$i]['data->custom_blocks->' . $j . '->' . $key]
                        = TableFields::getFormattedField($key, $value);
                };
            }
        }

        return TableCollectionResource::make(array_values($formatedArray))->setTotal($documents->total());
    }

}
