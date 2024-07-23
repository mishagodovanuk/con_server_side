<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait UserDataTrait
{
    public function scopeAddFullName($q)
    {
        return $q->addSelect(DB::raw("CONCAT(users.name, ' ', users.surname) AS full_name"));
    }

    public function scopeFilterByWorkspace($q)
    {
        return $q->leftJoin('user_working_data', 'users.id', '=', 'user_working_data.user_id')
            ->where('user_working_data.workspace_id', Workspace::current());
    }


    public function scopeWithWorkingData($q)
    {
        $workspace_id = Workspace::current();
        return $q->leftJoin('user_working_data', function ($join) use ($workspace_id) {
            $join->on('users.id', '=', 'user_working_data.user_id');
        })->where('user_working_data.workspace_id', '=', $workspace_id)
            ->addSelect('users.*', 'user_working_data.company_id',
                'user_working_data.position_id', 'user_working_data.driving_license_number',
                'user_working_data.health_book_number', 'user_working_data.driving_license_doctype',
                'user_working_data.health_book_doctype', 'user_working_data.driver_license_date',
                'user_working_data.health_book_date', 'user_working_data.user_id',
                'user_working_data.workspace_id', 'user_working_data.id as user_working_data_id')
            ->distinct();
    }

}
