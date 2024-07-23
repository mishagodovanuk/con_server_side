<?php

namespace App\Models;

use App\Events\RegistersChangedStatus;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Register extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'arrive' => 'datetime:H:i',
        'register' => 'date:H:i d.m.Y',
        'entrance' => 'date:H:i d.m.Y',
        'departure' => 'date:H:i d.m.Y',
    ];

    public function storekeeper()
    {
        return $this->hasOne(User::class, 'id', 'storekeeper_id');
    }

    public function manager()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    public function download_method()
    {
        return $this->hasOne(TransportDownload::class, 'id', 'download_method_id');
    }

    public function download_zone()
    {
        return $this->hasOne(DownloadZone::class, 'id', 'download_zone_id');
    }

    public function status()
    {
        return $this->hasOne(RegisterStatus::class, 'id', 'status_id');
    }

    public function updateWithRelations($data)
    {
        $relations = ['storekeeper', 'manager', 'download_zone', 'download_method', 'status'];

        foreach ($relations as $relation) {
            $data = $this->renameRelationField($relation, $data);
        }

        $this->update($data);

        broadcast(new RegistersChangedStatus($this->fresh()));
    }

    private function renameRelationField($relationName, $data)
    {
        if (array_key_exists($relationName, $data) && $relationName == 'download_zone') {
            $data[$relationName . '_id'] = DownloadZone::where('name', $data[$relationName])?->first()?->id;
            unset($data[$relationName]);
        } else if (array_key_exists($relationName, $data) && $relationName == 'download_method') {
            $data[$relationName . '_id'] = TransportDownload::where('name', $data[$relationName])?->first()?->id;
            unset($data[$relationName]);
        } else if (array_key_exists($relationName, $data) && $relationName == 'status') {
            $data[$relationName . '_id'] = RegisterStatus::where('name', $data[$relationName])?->first()?->id;
            unset($data[$relationName]);
        } else if (array_key_exists($relationName, $data)) {
            $data[$relationName . '_id'] = User::where(DB::raw("CONCAT(surname, ' ', LEFT(name, 1), '.')"), $data[$relationName])?->first()?->id;
            unset($data[$relationName]);
        }

        return $data;
    }
}
