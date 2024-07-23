<?php

namespace App\Services\Company;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormatTableData extends AbstractFormatTableData
{
    public function formatData($company)
    {
        $companyArr = [];
        for ($i = 0; $i < count($company); $i++) {
            $companyArr[] = $company[$i]->toArray();
            if ($company[$i]->company_type_id == 1) {
                $companyArr[$i]['name'] = "{$company[$i]->company->surname} {$company[$i]->company->first_name}";
            } else {
                $companyArr[$i]['name'] = $company[$i]->company->name;
            }
            $companyArr[$i]['property'] = Auth::id() === $company[$i]->creator_id ? 'Моя компанія' : 'Контрагент';
            $companyArr[$i]['type'] = $company[$i]->type->name;
            $companyArr[$i]['ipn'] = $company[$i]->ipn ?? '-';
            $companyArr[$i]['edrpou'] = $company[$i]->company_type_id == 2 ? $company[$i]->company->edrpou : '-';
            if ($company[$i]->address?->settlement?->name && $company[$i]->address?->street?->name
                && $company[$i]->address?->building_number) {
                $companyArr[$i]['address'] = $company[$i]->address->settlement->name . ' '
                    . $company[$i]->address->street->name . ' ' . $company[$i]->address->building_number;
            } else {
                $companyArr[$i]['address'] = $company[$i]->address->comment;
            }

        }

        return TableCollectionResource::make(array_values($companyArr))->setTotal($company->total());
    }

    public function renameFields($fieldName)
    {
        Log::info($fieldName);
        if ($fieldName == 'name') {
            $fieldName = DB::raw("CASE WHEN companies.company_type_id = 1 THEN (SELECT CONCAT(physical_companies.surname, ' ', physical_companies.first_name) FROM physical_companies WHERE physical_companies.id = companies.company_id) WHEN companies.company_type_id = 2 THEN (SELECT legal_companies.name FROM legal_companies WHERE legal_companies.id = companies.company_id) END");
        } else if ($fieldName == 'property') {
            $fieldName = DB::raw("CASE WHEN companies.creator_id = " . Auth::id() . " THEN 'Моя компанія' ELSE 'Контрагент' END");
        }

        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        $select = 'name';

        if ($relationName == 'type') {
            $select = 'company_types.name';
        } else if ($relationName == 'address') {
            $select = DB::raw("CONCAT(settlements.name, ' ', streets.name, ' ', address_details.`building_number`)");
        }

        return $select;
    }
}
