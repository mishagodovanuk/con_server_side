<?php

namespace App\Traits;

use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;

trait DocumentTypeDataTrait
{
    public function scopeNotArchiveOrDraft($query)
    {
        return $query->whereDoesntHave('status', function ($q) {
            $q->whereNotIn('key', ['archieve', 'draft']);
        });
    }

    public function scopeOnlySystemOrCurrentWorkspace($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('key')->orWhere('workspace_id', Workspace::current());
        });
    }
}
