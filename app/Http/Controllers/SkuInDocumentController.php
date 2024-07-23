<?php

namespace App\Http\Controllers;

use App\Models\SkuByDocument;
use App\Services\SkuInDocument\TableFacade;
use Illuminate\Http\Request;

class SkuInDocumentController extends Controller
{
    public function store(Request $request)
    {
        SkuByDocument::store($request->except('_token'));

        return response('OK');
    }

    public function tableStore(Request $request)
    {
        SkuByDocument::storeFromTable(json_decode($request->except('_token')['data'],true),$request->document_id);

        return response('OK');
    }

    public function filter(TableFacade $filter)
    {
        return $filter->getFilteredData();
    }
}
