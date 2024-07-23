<?php

namespace App\Services\File;

use App\Interfaces\StoreFileInterface;
use App\Models\FileLoad;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class StoreFile implements StoreFileInterface
{

    public function setFile($file, $pathName, $model, $fieldName, $modelId = null)
    {
        if ($file) {
            if ($model) {
                $this->deleteFile($pathName, $model, $fieldName);
                $modelId = $modelId ?? $model->id;
                FileLoad::where('path', $pathName)
                    ->where('new_name', $model->id . '.' . $model[$fieldName])
                    ->where('workspace_id', Workspace::current())
                    ->delete();
            }

            $extension = $file->getClientOriginalExtension();

            if ($modelId) {
                $file->move(storage_path('uploads/' . $pathName), $modelId . '.' . $extension);
            } else {
                $modelId = $model->id;
                $file->move(storage_path('uploads/' . $pathName), $model->id . '.' . $extension);
            }

            FileLoad::create([
                'name' => $file->getClientOriginalName(),
                'path' => $pathName,
                'new_name' => $modelId . '.' . $extension,
                'user_id' => Auth::id(),
                'workspace_id' => Workspace::current()
            ]);

            $model[$fieldName] = $extension;
            $model->save();
        }
    }

    public function deleteFile($pathName, $model, $fieldName, $modelId = null)
    {
        if ($model[$fieldName]) {
            if ($modelId) {
                $path = storage_path('uploads/' . $pathName . '/' . $modelId . '.' . $model[$fieldName]);
            } else {
                $path = storage_path('uploads/' . $pathName . '/' . $model->id . '.' . $model[$fieldName]);
            }

            if (File::exists($path)) {
                File::delete($path);
                FileLoad::where('path', $pathName)
                    ->where('new_name', $model->id . '.' . $model[$fieldName])
                    ->where('workspace_id', Workspace::current())->delete();
                $model[$fieldName] = null;
                $model->save();
            }
        }
    }

}
