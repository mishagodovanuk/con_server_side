<?php

namespace App\Http\Controllers;

use App\Models\ServiceByDocument;
use App\Services\ServiceInDocument\TableFacade;
use Illuminate\Http\Request;

class ServiceInDocumentController extends Controller
{
    public function store(Request $request)
    {
        ServiceByDocument::store($request->except('_token'));

        return response('OK');
    }

    public function tableStore(Request $request)
    {
        ServiceByDocument::storeFromTable(json_decode($request->except('_token')['data'],true),$request->document_id);

        return response('OK');
    }

    public function filter(TableFacade $filter)
    {
        return $filter->getFilteredData();
    }
}
