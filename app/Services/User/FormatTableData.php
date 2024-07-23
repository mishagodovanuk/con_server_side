<?php

namespace App\Services\User;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($users)
    {
        $usersArray = [];
        for ($i = 0; $i < count($users); $i++) {
            $usersArray[] = $users[$i]->toArray();

            $usersArray[$i]['position'] = array_key_exists('position_name',$usersArray[$i])
                ? $usersArray[$i]['position_name'] : null;
            $usersArray[$i]['role'] = $users[$i]->workingData->role[0]->title;

            $usersArray[$i]['company'] = $users[$i]->workingData->company->getName();
            $usersArray[$i]['is_online'] = $users[$i]->isOnline();
        }

        return TableCollectionResource::make(array_values($usersArray))->setTotal($users->total());
    }

    public function renameFields($fieldName)
    {
        if ($fieldName == 'is_online') {
            $fieldName = 'last_seen';
        } else if ($fieldName == 'full_name') {
            $fieldName = DB::raw("CONCAT(users.surname,' ',users.name)");
        } else if ($fieldName == 'position') {
            $fieldName = 'positions.name';
        } else if ($fieldName == 'role') {
            $fieldName = 'roles.name';
        } else if ($fieldName = 'company') {
            $fieldName = 'company_name';
        }

        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';
        if ($relationName == 'company') {
            $select = "CASE WHEN companies.company_type_id = 1 THEN (SELECT CONCAT(physical_companies.first_name, ' ', physical_companies.surname) FROM physical_companies WHERE physical_companies.id = companies.company_id) WHEN companies.company_type_id = 2 THEN (SELECT legal_companies.name FROM legal_companies WHERE legal_companies.id = companies.company_id) END";
        }

        return $select;
    }
}
