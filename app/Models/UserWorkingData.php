<?php

namespace App\Models;

use App\Interfaces\StoreFileInterface;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class UserWorkingData extends Model
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $guarded = [];

    protected $guard_name = 'web';

    protected $table = 'user_working_data';


    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'user_id', 'id');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function conditions()
    {
        return $this->hasMany(ScheduleException::class, 'user_id', 'id');
    }

    public function deleteDriver($user_id)
    {
        $file = resolve(StoreFileInterface::class);
        $file->deleteFile('driver/driving_license', $this, 'driving_license_doctype', $user_id);
        $file->deleteFile('driver/health_book', $this, 'health_book_doctype', $user_id);
    }

    public function updateSchedule(array $schedule)
    {
        Schedule::where('user_id', $this->id)->delete();
        Schedule::store($schedule, $this->id);
    }

    public function storeConditions(array $conditions)
    {
        $conditionArray = [];

        foreach ($conditions as $condition) {
            $conditionArray[] = [
                'date_from' => $condition['date_from'],
                'date_to' => $condition['date_to'] ?? null,
                'type_id' => $condition['type_id'],
                'user_id' => $this->id,
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

    public function updateConditions(array $conditions)
    {
        $conditionArray = [];
        ScheduleException::where('user_id', $this->id)->delete();
        foreach ($conditions as $condition) {
            $conditionArray[] = [
                'date_from' => $condition['date_from'],
                'date_to' => $condition['date_to'] ?? null,
                'type_id' => $condition['type_id'],
                'user_id' => $this->id,
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

    public function isAdmin()
    {
        return !is_null($this->role) && in_array($this->role->key, ['super_admin', 'admin']);
    }

    public function saveDriver($request)
    {
        $file = resolve(StoreFileInterface::class);
        $file->setFile($request->file('driving_license'), 'driver/driving_license', $this, 'driving_license_doctype');
        $file->setFile($request->file('health_book'), 'driver/health_book', $this, 'health_book_doctype');
        $this->update([
            'driving_license_number' => $request->driving_license_number,
            'health_book_number' => $request->health_book_number,
            'driver_license_date' => $request->driver_license_date,
            'health_book_date' => $request->health_book_date
        ]);
    }

}
