<?php

namespace App\Models;

use App\Traits\HasAddressDetails;
use App\Traits\HasWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes, HasAddressDetails, HasWorkspace;

    protected $guarded = [];

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'warehouse_id', 'id');
    }

    public function conditions()
    {
        return $this->hasMany(ScheduleException::class, 'warehouse_id', 'id');
    }

    public function address()
    {
        return $this->hasOne(AddressDetails::class, 'id', 'address_id');
    }

    public function type()
    {
        return $this->hasOne(WarehouseType::class, 'id', 'type_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function warehouseERP()
    {
        return $this->belongsToMany(WarehouseERP::class, 'warehouse_to_erp', 'warehouse_id', 'erp_id');
    }

    public static function store($request)
    {
        $schedule = json_decode($request->graphic, true);
        $conditions = json_decode($request->conditions, true);
        $address = AddressDetails::create(
            [
                'country_id' => $request->country,
                'settlement_id' => $request->settlement,
                'street_id' => $request->street,
                'building_number' => $request->building_number,
            ]
        );
        $warehouse = Warehouse::create([
            'type_id' => $request->type,
            'user_id' => $request->user,
            'name' => $request->name,
            'company_id' => $request->company,
            'address_id' => $address->id,
            'coordinates' => $request->coordinates,
            'addition_to_address' => $request->addition_to_address,
            'workspace_id' => Workspace::current()
        ]);

        $warehouse->warehouseERP()->attach(explode(',', $request->warehouse_erp));


        Schedule::store($schedule, warehouseId: $warehouse->id);
        $warehouse->storeConditions($conditions);
    }

    public function storeConditions($conditions)
    {
        $conditionArray = [];

        foreach ($conditions as $condition) {
            $conditionArray[] = [
                'date_from' => $condition['date_from'],
                'date_to' => $condition['date_to'] ?? null,
                'type_id' => $condition['type_id'],
                'warehouse_id' => $this->id,
                'work_from' => $condition['work_from'] ?? null,
                'work_to' => $condition['work_to'] ?? null,
                'break_from' => $condition['break_from'] ?? null,
                'break_to' => $condition['break_to'] ?? null,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ];
        }

        ScheduleException::insert($conditionArray);
    }

    public function updateConditions($conditions)
    {
        $conditionArray = [];
        ScheduleException::where('warehouse_id', $this->id)->delete();
        foreach ($conditions as $condition) {
            $conditionArray[] = [
                'date_from' => $condition['date_from'],
                'date_to' => $condition['date_to'] ?? null,
                'type_id' => $condition['type_id'],
                'warehouse_id' => $this->id,
                'work_from' => $condition['work_from'] ?? null,
                'work_to' => $condition['work_to'] ?? null,
                'break_from' => $condition['break_from'] ?? null,
                'break_to' => $condition['break_to'] ?? null,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ];
        }
        ScheduleException::insert($conditionArray);
    }

    public function delete()
    {
        Schedule::where('warehouse_id', $this->id)->delete();
        ScheduleException::where('warehouse_id', $this->id)->delete();
        AddressDetails::find($this->address_id)->delete();
        parent::delete();
    }


    public function updateMainData($request)
    {
        AddressDetails::find($this->address_id)->update(
            [
                'country_id' => $request->country,
                'settlement_id' => $request->settlement,
                'street_id' => $request->street,
                'building_number' => $request->building_number,
            ]
        );
        $this->update([
            'type_id' => $request->type,
            'user_id' => $request->user,
            'name' => $request->name,
            'company_id' => $request->company,
            'coordinates' => $request->coordinates,
            'addition_to_address' => $request->addition_to_address,
        ]);
    }
}
