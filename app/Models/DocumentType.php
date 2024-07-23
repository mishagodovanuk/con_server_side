<?php

namespace App\Models;

use App\Traits\DocumentTypeDataTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use HasFactory, DocumentTypeDataTrait, SoftDeletes;

    protected $guarded = [];

    public function status()
    {
        return $this->hasOne(DoctypeStatus::class, 'id', 'status_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'type_id', 'id');
    }

    public function settings()
    {
        return json_decode($this->settings, true);
    }

    public function getDictionaries(): array
    {
        $selectValuesArray = $this->getDictionaryArray($this->settings()['fields']);
        if (array_key_exists('document_type', $this->settings())) {
            $documents = DocumentType::whereIn('id', $this->settings()['document_type'])->get();
            foreach ($documents as $document) {
                $selectValuesArray = array_merge($selectValuesArray,
                    $this->getDictionaryArray($document->settings()['fields']));
            }
        }
        if(array_key_exists('custom_blocks',$this->settings())){
                $selectValuesArray = array_merge($selectValuesArray,
                    $this->getDictionaryArray($this->settings()['custom_blocks']));

        }

        return $selectValuesArray;
    }

    public function getRelatedDocumentsArray(): array
    {
        if (array_key_exists('document_type', $this->settings())) {
            return DocumentType::find($this->settings()['document_type'])
                ->toArray();
        }
        return [];
    }

    private function getDictionaryArray($fields): array
    {
        $selectValuesArray = [];
        foreach ($fields as $array) {
            foreach ($array as $value) {
                if ($value['type'] === 'select' || $value['type'] === 'label') {
                    if (!array_key_exists($value['directory'], $selectValuesArray)) ;
                    $dictionary = call_user_func('App\Factories\DictionaryFactory' . '::' . $value['directory'],false);
                    if (!is_array($dictionary)) {
                        $selectValuesArray[$value['directory']] = $dictionary ? $dictionary->take(10)->get()->toArray() : null;
                    } else {
                        $selectValuesArray[$value['directory']] = $dictionary;
                    }
                }
            }
        }
        return $selectValuesArray;
    }
}
