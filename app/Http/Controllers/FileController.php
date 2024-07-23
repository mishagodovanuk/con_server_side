<?php

namespace App\Http\Controllers;

use App\Models\FileLoad;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    const COMMON_PATH = ['company', 'user/avatars'];

    public function getFile($path)
    {
        $searchPath = substr($path, strlen("uploads/"));
        $storagePath = storage_path($path);

        if (File::exists($storagePath)) {
            $file = FileLoad::where(DB::raw('CONCAT(path,"/",new_name)'), $searchPath)->first();

            if ($file->workspace_id == Workspace::current()
                || in_array(dirname($path), self::COMMON_PATH)) {
                return response()->file($storagePath);
            } else {
                return response('Unauthorized', 403);
            }
        } else {
            return response('Not found', 404);
        }
    }
}
