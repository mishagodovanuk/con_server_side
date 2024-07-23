<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyDictionaryService
{
    public function getDictionaryList()
    {
        if (array_key_exists('id', $_GET)) {
            return Company::select('companies.id')->where('companies.id', $_GET['id'])->filterByWorkspace()->addName()->first();
        }

        if (array_key_exists('query', $_GET)) {
            return Company::select('companies.id')
                ->leftJoin('physical_companies', 'companies.company_id', '=', 'physical_companies.id')
                ->leftJoin('legal_companies', 'companies.company_id', '=', 'legal_companies.id')
                ->select([
                    'companies.id',
                    'companies.company_type_id',
                ])
                ->addSelect(DB::raw('
        CASE
            WHEN companies.company_type_id = 1 AND CONCAT(physical_companies.first_name, " ", physical_companies.surname) LIKE "%' . $_GET['query'] . '%" THEN CONCAT(physical_companies.first_name, " ", physical_companies.surname)
            WHEN companies.company_type_id = 2 AND legal_companies.name LIKE "%' . $_GET['query'] . '%" THEN legal_companies.name
            ELSE ""
        END AS name
    '))
                ->where(function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('companies.company_type_id', 1)
                            ->where(DB::raw('CONCAT(physical_companies.first_name, " ", physical_companies.surname)'), 'like', '%' . $_GET['query'] . '%');
                    })
                        ->orWhere(function ($subQuery) {
                            $subQuery->where('companies.company_type_id', 2)
                                ->where('legal_companies.name', 'like', '%' . $_GET['query'] . '%');
                        });
                })
                ->filterByWorkspace()
                ->limit(25)
                ->get();
        }

        return Company::select('companies.id')->filterByWorkspace()->limit(25)->addName()->get();
    }
}
