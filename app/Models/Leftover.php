<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leftover extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function goods(): BelongsTo
    {
        return $this->belongsTo(Goods::class, 'goods_id');
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function barcodes(): HasMany
    {
        return $this->hasMany(Barcode::class, 'goods_id', 'goods_id');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'goods_id', 'goods_id');
    }
}
