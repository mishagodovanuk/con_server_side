<?php

namespace App\Models;

use App\Traits\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\String\u;


class Document extends Model
{
    use HasFactory, HasWorkspace, SoftDeletes;

    protected $guarded = [];

    public function documentType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(DocumentType::class, 'id', 'type_id');
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(DocumentStatus::class, 'id', 'status_id');
    }

    public function relatedDocuments()
    {
        return $this->belongsToMany(Document::class, 'document_relations', 'document_id', 'related_id');
    }

    public function leftovers(): hasMany
    {
        return $this->hasMany(Leftover::class, 'document_id');
    }

    public function allBlocksToArray()
    {
        $data = json_decode($this->data, true);
        $headerFields = $data['header'];
        $customBlockFields = [];

        if (isset($data['custom_blocks']) && is_array($data['custom_blocks'])) {
            foreach ($data['custom_blocks'] as $block) {
                foreach ($block as $key => $value) {
                    $customBlockFields[$key] = $value;
                }
            }
        }

        return ['header'=>array_merge($headerFields, $customBlockFields),
            'header_ids' => $data['header_ids']];
    }


    public function goods()
    {
        return $this->belongsToMany(Goods::class, 'sku_by_documents', 'document_id', 'goods_id')->withPivot('count', 'data');
    }

    public function transport_plannings()
    {
        return $this->belongsToMany(
            TransportPlanning::class,
            'transport_planning_documents',
            'document_id',
            'transport_planing_id'
        )->withPivot('download_start', 'download_end', 'unloading_start', 'unloading_end');
    }

    public static function store($request)
    {
        $data = $request->except(['_token']);
        $files = $request->allFiles();

        $document = Document::create([
            'type_id' => $data['type_id'],
            'status_id' => $data['status_id'],
            'data' => $data['data'],
            'workspace_id' => Workspace::current()
        ]);

        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();
            $filenameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // To get the document, you should get the md5 hash of the concatenation result of the file name
            // (which is contained in the array values of field in the document), slash and the document id.
            // In this case, the value of the uploaded file name is always unique
            $file->move(public_path('uploads/documents'), hash('md5', $filenameWithoutExtension . '_' . $document->id) . '.' . $extension);
        }

        $relatedDocuments = json_decode($data['related_documents']);
        if (count($relatedDocuments)) {
            $relatedDocumentsArray = [];
            for ($i = 0; $i < count($relatedDocuments); $i++) {
                $existingRecord = DocumentRelation::where('document_id', $document->id)
                    ->where('related_id', $relatedDocuments[$i])
                    ->first();
                if (!$existingRecord) {
                    $relatedDocumentsArray[$i] = [
                        'document_id' => $document->id,
                        'related_id' => $relatedDocuments[$i]
                    ];
                };
            }
            DocumentRelation::insert($relatedDocumentsArray);
        }

        return $document->id;
    }

    public function updateData($request)
    {
        $this->update([
            'status_id' => $request['status_id'],
            'data' => $request['data']
        ]);

        return $this;
    }

    public function data()
    {
        return json_decode($this->data, true);
    }

    public static function storeRelated($data)
    {

        $type_id = $data['type_id'];
        unset($data['type_id']);
        $document = Document::find($data['document_id']);
        unset($data['document_id']);

        return Document::create([
            'status_id' => $document->status_id,
            'type_id' => $type_id,
            'data' => json_encode($data),
            'document_id' => $document->id,
            'workspace_id' => Workspace::current()
        ]);
    }
}
