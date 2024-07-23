<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportPlanningFailure extends Model
{
    protected $guarded = [];

    protected $table = 'transport_planning_failures';

    public function type()
    {
        return $this->belongsTo(TransportPlanningFailureType::class, 'type_id');
    }

    public function status()
    {
        return $this->belongsTo(TransportPlanningToStatus::class, 'status_id');
    }
}
