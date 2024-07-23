<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentTypeRequest;
use App\Models\DoctypeField;
use App\Models\DoctypeStatus;
use App\Models\DocumentType;
use App\Models\Workspace;
use App\Services\DocumentTypeInDocumentTable\FormatTableData;
use App\Services\DocumentTypeInDocumentTable\TableFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Predis\Response\Status;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::with('status')
            ->onlySystemOrCurrentWorkspace()
            ->get(['id', 'name', 'status_id']);

        $isAdmin = Auth::user()->isAdmin();

        return view('document-types.index', compact('documentTypes', 'isAdmin'));
    }

    public function create()
    {
        $doctypeFields = DoctypeField::all();
        $docTypes = DocumentType::where('status_id','!=',[1,3])->orWhereNull('status_id')->get(['id', 'name']);
        $isAdmin = Auth::user()->isAdmin();

        return view('document-types.create', compact('doctypeFields', 'docTypes', 'isAdmin'));
    }

    public function store(DocumentTypeRequest $request)
    {
        DocumentType::create(array_merge($request->validated(),['workspace_id' => Workspace::current()]));

        return response('OK');
    }

    public function storeDraft(DocumentTypeRequest $request)
    {
        $data = $request->validated();
        $data['status_id'] = DoctypeStatus::where('key', 'draft')->first()->id;
        $data['workspace_id'] = Workspace::current();
        DocumentType::create($data);
        return response('OK');
    }

    public function edit(DocumentType $documentType)
    {
        $doctypeFields = DoctypeField::all();
        $docTypes = DocumentType::where('status_id','!=',[1,3])->orWhereNull('status_id')->where('id','!=',$documentType->id)->get(['id', 'name']);
        return view('document-types.edit', compact('documentType', 'docTypes', 'doctypeFields'));
    }

    public function update(DocumentTypeRequest $request, DocumentType $documentType)
    {

        $documentType->update($request->validated());

        return response('OK');
    }

    public function destroy(DocumentType $documentType)
    {
        $documentType->delete();
        return redirect()->back();
    }

    public function changeStatus($statusKey, DocumentType $documentType)
    {
        if ($statusKey !== "null") {
            $status = DoctypeStatus::where('key', $statusKey)->first()->id;
        } else {
            $status = null;
        }

        $documentType->update(['status_id' => $status]);

        return redirect()->back();
    }

    public function preview()
    {

        return view('document-types.preview');
    }

    public function filter(TableFacade $filter)
    {
        return $filter->getFilteredData();
    }
}
