<?php

namespace App\Traits;

trait WorkspaceDataTrait
{
    public function scopeRelations($query)
    {
        $query->with(['owner'])->withCount('companies');
    }

    public function scopeFilterCompaniesByUser($query, $userId)
    {
        $query->whereHas('companies', function ($q) use ($userId) {
            $q->whereHas('users', function ($q) use ($userId) {
                $q->where('user_working_data.user_id', $userId);
            });
        });
    }
}
