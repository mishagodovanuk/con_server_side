<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalEquipmentBrand extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    public function models()
    {
        return $this->hasMany(AdditionalEquipmentModel::class,'brand_id','id');
    }
}
