<?php

namespace App\Models\Match;

use App\Models\CargoType;
use App\Models\Document;
use App\Models\TransportPlanning;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consolidation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function cargoTypes()
    {
        return $this->belongsToMany(CargoType::class, 'cargo_type_to_consolidation', 'consolidation_id', 'cargo_type_id');
    }

    public function reject()
    {
        return $this->hasOne(ConsolidationReject::class, 'id', 'reject_id');
    }

    public function transportPlanning()
    {
        return $this->belongsToMany(TransportPlanning::class, 'transport_planning_to_consolidations', 'consolidation_id', 'tp_id');
    }

    public function goodsInvoices()
    {
        return $this->belongsToMany(Document::class, 'goods_invoice_to_consolidations', 'consolidation_id', 'goods_invoice_id');
    }

    public function cargoRequest()
    {
        return $this->belongsToMany(Document::class, 'cargo_request_to_consolidations', 'consolidation_id', 'cargo_request_id');
    }
    public function transportRequest()
    {
        return $this->belongsToMany(Document::class, 'transport_request_to_consolidation', 'consolidation_id', 'tp_d')->first();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
