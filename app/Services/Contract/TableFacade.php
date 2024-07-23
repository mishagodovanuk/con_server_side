<?php

namespace App\Services\Contract;

use App\Enums\ContractStatus;
use App\Models\Company;
use App\Models\Contract;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\Auth;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = [
            'company' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'counterparty' => function ($q) {
                $q->select('companies.id')->addName();
            },
        ];
        $transports = Contract::with($relationFields)
            ->where(function ($q) {
                $q->where('workspace_id', Auth::user()->current_workspace_id)
                    ->orWhere(function ($q) {
                        $companyIds = Company::where('workspace_id', Auth::user()->current_workspace_id)
                            ->pluck('id');
                        $q->where('status', '>=', ContractStatus::PENDING_CONSOLIDATION)
                            ->whereIn('counterparty_id', $companyIds);
                    });
            });

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $transports);
    }
}
