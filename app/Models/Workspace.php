<?php

namespace App\Models;

use App\Interfaces\StoreFileInterface;
use App\Traits\WorkspaceDataTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Workspace extends Model
{
    use SoftDeletes, WorkspaceDataTrait, HasFactory;

    protected $guarded = [];

    public function owner(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function usersInWorkspace()
    {
        return $this->belongsToMany(User::class, 'user_working_data');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'workspace_id', 'id');
    }

    public static function store($request)
    {
        $data = $request->except(['_token', 'avatar']);
        $data['user_id'] = Auth::id();

        $workspace = Workspace::create($data);

        $workspace->setAvatar($request);

        return $workspace->id;
    }

    public function updateData($request)
    {
        $data = $request->except(['_token', 'avatar']);

        if ($request->hasFile('avatar') || $request->get('avatar_color')) {
            $this->setAvatar($request);
        }

        $this->fill($data);
        $this->save();

        return $this->id;
    }

    public function setAvatar($request)
    {
        if ($request->hasFile('avatar')) {
            $file = resolve(StoreFileInterface::class);
            $file->setFile($request->file('avatar'), 'workspace/avatars', $this, 'avatar_type');
        }

        if ($request->avatar_color) {
            $this->avatar_color = $request->avatar_color;
        }

        $this->save();
    }

    public static function current() : int | null
    {
        return Auth::user()->current_workspace_id;
    }
}
