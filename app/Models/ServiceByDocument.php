<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceByDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function store(array $data)
    {

        $dataArray = json_decode('[' . $data['data'] . ']', true);

        $insertArray = [];

        foreach ($dataArray as &$item) {
            $insertArray[] = [
                'service_id' => $item['service_id'],
                'document_id' => $data['document_id'],
                'data' => json_encode(array_diff_key($item, ['service_id' => ''])),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        parent::insert($insertArray);
    }

    public static function storeFromTable($data, $documentID)
    {
        $serviceID = $data['service_id'];

        $serviceByDoc = parent::create([
            'service_id' => $serviceID,
            'document_id' => $documentID,
            'data' => json_encode(array_diff_key($data, ['service_id' => '']))
        ]);

        return $serviceByDoc->id;
    }
}
