<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $timestamps = false;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function counterparty()
    {
        return $this->belongsTo(Company::class, 'counterparty_id');
    }

    public function company_regulation()
    {
        return $this->belongsTo(Regulation::class, 'company_regulation_id');
    }

    public function counterparty_regulation()
    {
        return $this->belongsTo(Regulation::class, 'counterparty_regulation_id');
    }

    public function comments()
    {
        return $this->hasMany(ContractComment::class, 'contract_id');
    }
}
