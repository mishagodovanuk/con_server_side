<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Workspace;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TableFacade
{
    public static function getFilteredData()
    {
        $relationFields = ['usersInWorkspace','schedule', 'conditions'];

        $users = User::with($relationFields)
            ->filterByWorkspace()
            ->leftJoin('positions', 'user_working_data.position_id', '=', 'positions.id')
            ->leftJoin('companies', 'user_working_data.company_id', '=', 'companies.id')
            ->leftJoin(DB::raw("(SELECT companies.id, CASE WHEN companies.company_type_id = 1
            THEN CONCAT(physical_companies.first_name, ' ', physical_companies.surname)
            ELSE legal_companies.name END as company_name FROM companies LEFT JOIN
            physical_companies ON companies.company_id = physical_companies.id LEFT JOIN
            legal_companies ON companies.company_id = legal_companies.id) as company_with_details"),
                'user_working_data.company_id', '=', 'company_with_details.id')
            ->select(
                'user_working_data.*',
                'positions.name AS position_name',
                'companies.id as company_id',
                'users.*',
            );


        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $users);
    }
}
