<?php

namespace App\Models\Match;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionsToConsolidation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function consolidation()
    {
        return $this->hasOne(Consolidation::class, 'id', 'consolidation_id');
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');
    }

}
