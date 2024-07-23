<?php

namespace App\Services\File;

use App\Interfaces\StoreImageInterface;
use App\Models\FileLoad;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StoreImage implements StoreImageInterface
{

    public function setImage($request, $model, $path, $column = 'img_type')
    {
        if ($model) {
            $this->deleteImage($model, $path, $column);
            FileLoad::where('path', $path)->where('new_name','like',$model->id.'.%')
                ->delete();
        }
        $extension = $request->file('image')->extension();

        $request->file('image')->move(storage_path('uploads/' . $path), $model->id . '.' . $extension);

        FileLoad::create([
            'name' => $request->file('image')->getClientOriginalName(),
            'path' => $path,
            'new_name' => $model->id . '.' . $extension,
            'user_id' => Auth::id(),
            'workspace_id' => Workspace::current()
        ]);

        $model[$column] = $extension;
        $model->save();
    }


    public function deleteImage($model, $path, $column = 'img_type')
    {
        if ($model[$column]) {
            $newPath = storage_path('uploads/' . $path . '/' . $model->id . '.' . $model[$column]);
            if (File::exists($newPath)) {
                File::delete($newPath);
                FileLoad::where('path', $path)->where('user_id', Auth::id())
                    ->delete();
                $model[$column] = null;
                $model->save();
            }
        }
    }
}
