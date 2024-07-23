<?php

namespace App\Models\Match;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidationTripPrice extends Model
{
    use HasFactory;

    public function consolidation()
    {
        return $this->hasOne(Consolidation::class, 'id', 'consolidation_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
