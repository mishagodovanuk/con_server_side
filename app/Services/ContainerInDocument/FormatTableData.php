<?php

namespace App\Services\ContainerInDocument;

use App\Http\Resources\TableCollectionResource;
use App\Services\Document\TableFields;
use App\Services\Table\AbstractFormatTableData;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($container)
    {
        $formatedArray = [];
        for ($i = 0; $i < count($container); $i++) {

            $formatedArray[] = $container[$i]->toArray();

            foreach (json_decode($formatedArray[$i]['data'], true) as $key => $value) {
                $formatedArray[$i]['data->'.$key] = TableFields::getFormattedField($key,$value);
            };
        }

        return TableCollectionResource::make(array_values($formatedArray))->setTotal($container->total());
    }

}
