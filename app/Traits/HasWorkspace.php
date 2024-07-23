<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasWorkspace
{
    public function scopeCurrentWorkspace($query)
    {
        return $query->where('workspace_id', Auth::user()->current_workspace_id);
    }
}
