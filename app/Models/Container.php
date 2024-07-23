<?php

namespace App\Models;

use App\Traits\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Container extends Model
{
    use HasFactory, SoftDeletes, HasWorkspace;

    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function workspace()
    {
        return $this->belongsTo(Company::class, 'workspace_id');
    }

    public function type()
    {
        return $this->belongsTo(ContainerType::class, 'type_id');
    }

    public function getAllData() : array{
        $dataArray = [];
        $dataArray['name'] = $this->name;+
        $dataArray['height'] = $this->height;
        $dataArray['width'] = $this->width;
        $dataArray['length'] = $this->depth;
        $dataArray['weight'] = $this->weight;
        $dataArray['wms_leftovers'] = 1234;
        $dataArray['erp_leftovers'] = 4321;

        return $dataArray;
    }
}
