<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type(): HasOne
    {
        return $this->hasOne(PackageType::class, 'id', 'type_id');
    }
}
