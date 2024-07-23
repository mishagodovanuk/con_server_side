<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalCompany extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public $timestamps = false;

    public function related()
    {
        return $this->morphOne(Company::class, 'company');
    }

    public function legal_type()
    {
        return $this->hasOne(LegalType::class, 'id', 'legal_type_id');
    }

    public function address()
    {
        return $this->hasOne(AddressDetails::class, 'id', 'legal_address_id');
    }
}
