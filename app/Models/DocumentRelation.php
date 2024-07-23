<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRelation extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    public static function storeByArray($dataArray){
        $relatedDocuments = json_decode($dataArray['related_documents']);
        for ($i=0;$i<count($relatedDocuments);$i++){
        parent::firstOrCreate([
            'document_id' => $dataArray['document_id'],
            'related_id' => $relatedDocuments[$i]
        ]);
        }
    }

}
