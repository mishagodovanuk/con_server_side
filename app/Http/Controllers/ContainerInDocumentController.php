<?php

namespace App\Http\Controllers;

use App\Models\ContainerByDocument;
use App\Services\ContainerInDocument\TableFacade;
use Illuminate\Http\Request;

class ContainerInDocumentController extends Controller
{
    public function store(Request $request)
    {
        ContainerByDocument::store($request->except('_token'));

        return response('OK');
    }

    public function tableStore(Request $request)
    {
        ContainerByDocument::storeFromTable(json_decode($request->except('_token')['data'],true),$request->document_id);

        return response('OK');
    }

    public function filter(TableFacade $filter)
    {
        return $filter->getFilteredData();
    }
}
