<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkuByDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function goods()
    {
        return $this->belongsTo(Goods::class, 'goods_id');
    }

    public static function store(array $data)
    {

        $dataArray = json_decode('[' . $data['data'] . ']', true);

        $insertArray = [];
        foreach ($dataArray as &$item) {
            $skuID = $item['sku_id'];
            $count = $item['count'];
            $item = array_diff_key($item, ['sku_id' => '', 'count' => '']);

            $insertArray[] = [
                'goods_id' => $skuID,
                'document_id' => $data['document_id'],
                'count' => $count,
                'data' => json_encode($item),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        SkuByDocument::insert($insertArray);
    }

    public static function storeFromTable($data, $documentID)
    {
        $skuID = $data['sku_id'];
        $count = $data['count'];

        //delete keys
        $data = array_diff_key($data, ['sku_id' => '', 'count' => '', 'sku_category' => '']);

        $skuByDoc = SkuByDocument::create([
            'goods_id' => $skuID,
            'document_id' => $documentID,
            'count' => $count,
            'data' => json_encode($data)
        ]);
        return $skuByDoc->id;
    }
}
