<?php

namespace App\Traits;

use App\Models\Workspace;
use Illuminate\Support\Facades\DB;

trait CompanyDataTrait
{

    public function scopeAddName($q)
    {
        return $q->leftJoin('physical_companies', 'companies.company_id', '=', 'physical_companies.id')
            ->leftJoin('legal_companies', 'companies.company_id', '=', 'legal_companies.id')
            ->addSelect(DB::raw("(CASE WHEN companies.company_type_id = 1 THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname) ELSE legal_companies.name END) as name"));
    }

    public function scopeFilterByWorkspace($q)
    {
        return $q->where(function ($query) {
            $query->whereHas('companiesInWorkspace', function ($subQuery) {
                $subQuery->where('company_to_workspaces.workspace_id', Workspace::current());
            })->orWhere('companies.workspace_id', Workspace::current());
        });
    }

}
