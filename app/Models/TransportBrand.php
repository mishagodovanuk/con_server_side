<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportBrand extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public function models()
    {
        return $this->hasMany(TransportModel::class,'brand_id','id');
    }
}
