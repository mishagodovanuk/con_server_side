<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

class ContractComment extends Model
{
    protected $guarded = [];

    public $table = 'contracts_comments';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
