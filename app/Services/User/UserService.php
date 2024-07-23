<?php

namespace App\Services\User;

use App\Models\ExceptionType;
use App\Models\FileLoad;
use App\Models\Position;
use App\Models\Schedule;
use App\Models\SchedulePattern;
use App\Models\User;
use App\Models\UserWorkingData;
use App\Models\Workspace;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{
    public static function create()
    {
        $user = null;

        if (array_key_exists('email', $_GET)) {
            $user = User::where('email', $_GET['email'])->first();
        } else if (array_key_exists('phone', $_GET)) {
            $user = User::where('phone', $_GET['phone'])->first();
        }

        $positions = Position::all();
        $patterns = SchedulePattern::where('type', 'user')->where('workspace_id', Workspace::current())->get();
        $exceptions = ExceptionType::all('id', 'name');

        $roles = Role::where('visible', 1)->orWhere('workspace_id', Workspace::current())
            ->get(['id', 'name', 'title']);


        return [
            'positions' => $positions,
            'patterns' => $patterns,
            'exceptions' => $exceptions,
            'roles' => $roles,
            'user' => $user
        ];
    }

    public static function store($request)
    {
        $schedule = json_decode($request->graphic, true);
        $conditions = json_decode($request->conditions, true);
        $position_id = (Position::where('key', $request->position)->first('id'))->id;
        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
                'birthday' => $request->birthday,
                'phone' => $request->phone,
                'email' => $request->email,
                "sex" => $request->sex,
                'password' => Hash::make($request->password),
            ]);
        }

        $workingData = UserWorkingData::create([
            'position_id' => $position_id,
            "company_id" => $request->company_id,
            'user_id' => $user->id,
            'workspace_id' => Workspace::current()
        ]);

        $workingData->assignRole($request->role);

        if ($workingData->position->key == 'driver') {
            $workingData->saveDriver($request);
        }

        $user->setAvatar($request);
        Schedule::store($schedule, $workingData->id);
        $workingData->storeConditions($conditions);
        return $user;
    }

    public static function update($user_id)
    {
        $user = User::where('users.id', $user_id)->withWorkingData()->first();

        $dataArray['positions'] = Position::all();
        $dataArray['exceptions'] = ExceptionType::all('id', 'name');

        $dataArray['patterns'] = SchedulePattern::where('type', 'user')->where('workspace_id', Workspace::current())->get();

        if ($user->workingData->position?->key == 'driver') {

            $dataArray['healthBookFile'] = FileLoad::where('path', 'driver/health_book')
                ->where('new_name', $user->workingData->id . '.' . $user->workingData->health_book_doctype)
                ->first();

            $dataArray['drivingLicenseFile'] = FileLoad::where('path', 'driver/driving_license')
                ->where('new_name', $user->workingData->id . '.' . $user->workingData->driving_license_doctype)
                ->first();
        }

        $dataArray['user'] = $user;
        $dataArray['roles'] = Role::where('visible', 1)->orWhere('workspace_id', Workspace::current())
            ->get(['id', 'name', 'title']);

        return $dataArray;
    }

    public static function changePassword($request, $user)
    {
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['errors' => ['old_password' => "Не правильно введний старий пароль. Спробуйте ще раз"]]);
        } elseif ($request->login && $user->login != $request->login) {
            return response()->json(['errors' => ['login' => "Не правильно введний логін"]]);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
    }
}
