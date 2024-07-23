<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKUCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['parent_id', 'name'];
    protected $table = 'sku_categories';

    public function children()
    {
        return $this->hasMany('App\Models\SKUCategory', 'parent_id');
    }

    public function isChild()
    {
        return $this->parent_id != null;
    }
}
