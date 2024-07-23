<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportPlanningDocument extends Model
{
    protected $guarded = [];

    public function transport_planing(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TransportPlanning::class, 'id', 'transport_planing_id');
    }

    public function document(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Document::class, 'id', 'document_id');
    }
}
