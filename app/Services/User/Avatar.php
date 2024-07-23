<?php

namespace App\Services\User;

use App\Interfaces\AvatarInterface;
use App\Models\FileLoad;
use App\Models\Workspace;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class Avatar implements AvatarInterface
{
    public function setAvatar($request, $user)
    {
        $this->deleteAvatarIfExist($user);

        $extension = $request->file('avatar')->extension();
        $request->file('avatar')->move(storage_path('uploads/user/avatars'), $user->id . '.' . $extension);

        FileLoad::create([
            'name' => $request->file('avatar')->getClientOriginalName(),
            'path' => 'user/avatars',
            'new_name' => $user->id . '.' . $extension,
            'user_id' => Auth::id(),
            'workspace_id' => Workspace::current()
        ]);

        $user->avatar_type = $extension;
        $user->save();
    }


    public function deleteAvatarIfExist($user)
    {
        if ($user->avatar_type) {
            $path = storage_path('uploads/user/avatars/' . $user->id . '.' . $user->avatar_type);
            if (File::exists($path)) {
                File::delete($path);
                FileLoad::where('path', 'user/avatars')
                    ->where('new_name', $user->id . '.' . $user->avatar_type)
                    ->delete();
                $user->avatar_type = null;
                $user->save();
            }
        }
    }
}
