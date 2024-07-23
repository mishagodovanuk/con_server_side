<?php

namespace App\Services\Service;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($services)
    {
        $servicesArr = [];
        for ($i = 0; $i < count($services); $i++) {
            $servicesArr[] = $services[$i]->toArray();
            $servicesArr[$i]['category'] = $services[$i]->category->name;
        }

        return TableCollectionResource::make(array_values($servicesArr))->setTotal($services->total());
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

        if ($relationName == 'category') {
            $select = 'service_categories.name';
        }

        return $select;
    }
}
