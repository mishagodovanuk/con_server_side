<?php

namespace App\Http\Controllers;


use App\Models\ContainerType;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\ServiceCategories;
use App\Models\SKUCategory;
use App\Models\Workspace;
use App\Services\Document\TableFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::withCount(['documents as documents_count' => function ($query) {
            $query->where('workspace_id', Workspace::current());
        }])->onlySystemOrCurrentWorkspace()
            ->notArchiveOrDraft()
            ->get();
        $isAdmin = Auth::user()->isAdmin();
        return view('documents.list', compact('documentTypes', "isAdmin"));
    }

    public function table(DocumentType $documentType)
    {
        $documentsCount = Document::where('type_id', $documentType->id)
            ->where('workspace_id', Workspace::current())->count();
        return view('documents.index', compact('documentsCount', 'documentType'));
    }

    public function create(DocumentType $documentType)
    {
        $categories = SKUCategory::all();
        $containerTypes = ContainerType::all();
        $relatedDocumentsArray = $documentType->getRelatedDocumentsArray();
        $serviceCategories = ServiceCategories::all();
        return view('documents.create', compact('documentType', 'categories', 'relatedDocumentsArray', 'containerTypes', 'serviceCategories'));
    }

    public function store(Request $request)
    {
        $document_id = Document::store($request);

        return response()->json(['document_id' => $document_id]);
    }

    public function show(Document $document)
    {
        $templateID = $document->documentType->settings()['layout'];
        $documentType = $document->documentType;
        $relatedDocumentsArray = $documentType->getRelatedDocumentsArray();

        return view('documents.template-' . $templateID, compact('document', 'documentType', 'relatedDocumentsArray'));
    }

    public function edit(Document $document)
    {
        $documentType = DocumentType::find($document->type_id);
        $relatedDocumentsArray = $documentType->getRelatedDocumentsArray();
        $categories = SKUCategory::all();
        $containerTypes = ContainerType::all();
        $serviceCategories = ServiceCategories::all();
        return view('documents.update', compact('documentType', 'document', 'categories', 'relatedDocumentsArray', 'containerTypes', 'serviceCategories'));
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->except(['_token', '_method']);
        $document->updateData($data);

        return response()->json(['document_id' => $document->id]);
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return response('Deleted');
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function createRelatedDocument(Request $request)
    {
        $data = $request->except(['_token']);
        Document::storeRelated($data);
        return response('OK');
    }
}
