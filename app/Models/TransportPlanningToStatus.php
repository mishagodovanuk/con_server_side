<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportPlanningToStatus extends Model
{
    protected $guarded = [];

    protected $table = 'transport_planning_to_statuses';

    public function address()
    {
        return $this->belongsTo(AddressDetails::class, 'address_id');
    }

    public function transport_planning()
    {
        return $this->belongsTo(TransportPlanning::class, 'transport_planning_id');
    }

    public function status()
    {
        return $this->belongsTo(TransportPlanningStatus::class, 'status_id');
    }

    public function failure()
    {
        return $this->hasOne(TransportPlanningFailure::class, 'status_id');
    }
}
