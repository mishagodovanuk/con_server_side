<?php

namespace App\Models;

use App\Interfaces\AvatarInterface;

use App\Traits\UserDataTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable, UserDataTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
        'last_seen' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function delete()
    {
        Schedule::where('user_id', $this->id)->delete();
        ScheduleException::where('user_id', $this->id)->delete();
        $this->removeAvatar();
        if ($this->position->name == 'driver')
            $this->deleteDriver();
        return parent::delete();
    }

    public function workingData()
    {
        return $this->hasOne(UserWorkingData::class, 'user_id', 'id')
            ->where('workspace_id', Workspace::current());
    }

    public function usersInWorkspace()
    {
        return $this->belongsToMany(Workspace::class, 'user_working_data', 'user_id');
    }

    public function createdCompanies()
    {
        return $this->hasMany(Company::class, 'creator_id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'user_id', 'id');
    }

    public function updateData($request)
    {
        $this->update($request->only(['surname', 'name', 'patronymic', 'birthday', 'phone', 'email', 'sex']));

        $workingData = $this->workingData()->first();

        $workingData->role()->where('workspace_id',Workspace::current())->delete();

        $workingData->assignRole($request->role);

        $workingData->position_id = (Position::where('key', $request->position)->first(['id']))->id;

        if ($request->position === 'driver') {
            if ($request->need_file) {
                $workingData->saveDriver($request,$this);
            } else {
                $workingData->health_book_number = $request->health_book_number;
                $workingData->driving_license_number = $request->driving_license_number;
                $workingData->driver_license_date = $request->driver_license_date;
                $workingData->health_book_date = $request->health_book_date;
            }
        }
        $workingData->save();
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'user_id', 'id');
    }


    public function workspaces()
    {
        return $this->belongsToMany(
            Workspace::class,
            'user_working_data',
            'user_id',
            'workspace_id'
        );
    }

    public function current_workspace()
    {
        return $this->hasOne(Workspace::class, 'id', 'current_workspace_id');
    }

    public function isOnline(): bool
    {
        return Cache::has('is_online' . $this->id);
    }

    public function setAvatar($request)
    {
        $avatar = resolve(AvatarInterface::class);
        if ($request->avatar) {
            $avatar->setAvatar($request, $this);
        }
    }

    public function removeAvatar()
    {
        $avatar = resolve(AvatarInterface::class);
        if ($this->avatar_type) {
            $avatar->deleteAvatarIfExist($this);
        }
    }

    public function updateOnboarding($array)
    {
        $array['new_user'] = 0;
        $this->update($array);
    }

    public function conditions()
    {
        return $this->hasMany(ScheduleException::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return !is_null($this->role) && in_array($this->role->key, ['super_admin', 'admin']);
    }

}
