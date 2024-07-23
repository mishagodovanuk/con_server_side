<?php

namespace App\Models;

use App\Traits\AddressDetailsDataTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetails extends Model
{
    use HasFactory, AddressDetailsDataTrait;

    protected $guarded = [];

    public $timestamps = false;

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function settlement()
    {
        return $this->hasOne(Settlement::class, 'id', 'settlement_id');
    }

    public function street()
    {
        return $this->hasOne(Street::class, 'id', 'street_id');
    }
}
