<?php

namespace App\Models;

use App\Traits\HasAddressDetails;
use Illuminate\Database\Eloquent\Model;

class TransportPlanningStatus extends Model
{
    use HasAddressDetails;

    protected $guarded = [];

    protected $table = 'transport_planning_statuses';
}
