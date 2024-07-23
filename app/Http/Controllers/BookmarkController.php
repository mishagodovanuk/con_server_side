<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\BookmarkRequest;
use App\Models\Bookmark;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(BookmarkRequest $request)
    {
        $bookmarkData = $request->validated();
        $bookmarkData['user_id'] = Auth::id();

        Bookmark::create($bookmarkData);

        return response()->json([
            'message' => 'Bookmark created successfully'
        ]);
    }

    public function findByKey($key){
        $bookmark = Bookmark::where('user_id',Auth::id())->where('key',$key)->first();

        return response()->json([$bookmark]);
    }
    public function deleteByKey(Request $request)
    {
        Bookmark::where('user_id',Auth::id())->where('key',$request->key)->delete();

        return response()->json([
            'message' => 'Bookmark deleted successfully'
        ]);
    }
}
