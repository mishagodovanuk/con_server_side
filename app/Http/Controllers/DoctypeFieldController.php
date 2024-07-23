<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctypeFieldRequest;
use App\Models\DoctypeField;
use App\Models\Workspace;


class DoctypeFieldController extends Controller
{
    public function store(DoctypeFieldRequest $request)
    {
        DoctypeField::create(array_merge($request->all(),['workspace_id' => Workspace::current()]));

        return response('OK');
    }


    public function destroy($key)
    {
        DoctypeField::where('key',$key)->first()->delete();

        return response('OK');
    }
}
