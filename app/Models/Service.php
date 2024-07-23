<?php

namespace App\Models;

use App\Traits\HasWorkspace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes, HasWorkspace;

    protected $guarded = [];

    public function category() :BelongsTo
    {
        return $this->belongsTo(ServiceCategories::class, 'category_id');
    }
}
