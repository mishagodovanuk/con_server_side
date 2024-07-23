<?php

namespace App\Models;

use App\Models\Match\Consolidation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoType extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function consolidations()
    {
        return $this->belongsToMany(Consolidation::class, 'cargo_type_to_consolidation', 'cargo_type_id', 'consolidation_id');
    }
}
