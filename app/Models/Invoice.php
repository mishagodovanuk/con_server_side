<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $guarded = [];

    public function company_provider()
    {
        return $this->belongsTo(Company::class, 'company_provider_id');
    }

    public function company_customer()
    {
        return $this->belongsTo(Company::class, 'company_customer_id');
    }

    public function responsible_supply()
    {
        return $this->belongsTo(Company::class, 'responsible_supply_id');
    }

    public function responsible_receive()
    {
        return $this->belongsTo(Company::class, 'responsible_receive_id');
    }

    public function documents()
    {
        return $this->belongsToMany(
            Document::class,
            'invoice_documents',
            'invoice_id',
            'document_id'
        );
    }
}
