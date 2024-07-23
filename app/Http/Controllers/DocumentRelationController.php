<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentRelation;
use App\Services\DocumentType\TableFacade;
use Illuminate\Http\Request;

class DocumentRelationController extends Controller
{
    public function store(Request $request){
        DocumentRelation::storeByArray($request->except('_token'));

        return response('OK');
    }

    public function delete($document_id,$related_id){
        DocumentRelation::where('document_id',$document_id)
            ->where('related_id',$related_id)?->delete();

        return response('OK');
    }

    public function filter(TableFacade $filter)
    {
        return $filter->getFilteredData();
    }
}
