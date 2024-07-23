<?php

namespace App\Models;

use App\Traits\HasWorkspace;
use App\Traits\RegulationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Regulation extends Model
{
    use SoftDeletes, NodeTrait, HasWorkspace, RegulationTrait;

    protected $guarded = [];

    const COMMERCIAL_TYPE = 0;
    const WAREHOUSE_TYPE = 1;
    const TRANSPORT_TYPE = 2;

    const CUSTOMER_SIDE = 0;

    const PERFORMER_SIDE = 1;

    /*public function contracts() :HasMany
    {
        return $this->hasMany(Contract::class, 'category_id');
    }

    public function companyContracts() {
        return $this->hasMany(Contract::class, 'company_regulation_id');
    }

    public function counterpartyContracts() {
        return $this->hasMany(Contract::class, 'counterparty_regulation_id');
    }

    public function allContracts() {
        return $this->companyContracts->merge($this->counterpartyContracts);
    }*/

    public static function store($request)
    {
        $data = $request->except(['_token']);

        $data['workspace_id'] = $request->user()->current_workspace_id;

        $regulation = Regulation::create($data);

        Regulation::fixTree();

        return $regulation->id;
    }
}
