<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalEquipmentModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(AdditionalEquipmentBrand::class, 'brand_id');
    }
}
