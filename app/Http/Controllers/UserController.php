<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AvatarRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\PinRequest;
use App\Http\Requests\User\UpdateOnboardingRequest;
use App\Http\Requests\User\UpdatePrivateDataRequest;
use App\Http\Requests\User\WorkingDataRequest;
use App\Interfaces\AvatarInterface;
use App\Mail\SendPasswordEmail;
use App\Models\ExceptionType;
use App\Models\FileLoad;
use App\Models\Position;
use App\Models\User;
use App\Models\UserWorkingData;
use App\Models\Workspace;
use App\Services\User\TableFacade;
use App\Services\User\UserService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function updateData(WorkingDataRequest $request, User $user)
    {
        $user->updateData($request);
        $workingData = $user->workingData()->first();
        $workingData->updateSchedule(json_decode($request->schedule, true));
        $workingData->updateConditions(json_decode($request->conditions, true));
        return response()->json(['success' => "Дані успішно змінено"]);
    }

    public function changePassword(PasswordRequest $request, User $user)
    {
        UserService::changePassword($request, $user);

        return response()->json(['success' => "Пароль успішно змінено"]);
    }


    public function updateAvatar(AvatarRequest $request, User $user, AvatarInterface $avatar)
    {
        $avatar->setAvatar($request, $user);
        return redirect()->back();
    }

    public function deleteAvatar(User $user, AvatarInterface $avatar)
    {
        $avatar->deleteAvatarIfExist($user);
        return redirect()->back();
    }

    public function update($id)
    {
        $dataArray = UserService::update($id);

        return view('user.update-profile', $dataArray);
    }

    public function users()
    {
        $usersAll = User::all();
        $positions = Position::all();
        return view('user.all', compact('positions', 'usersAll'));
    }

    public function create()
    {
        $data = UserService::create();
        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        UserService::store($request);
        return response('OK');
    }

    public function show($id)
    {

        $user = User::where('users.id', $id)->withWorkingData()->first();

        if ($user->workingData->position?->key == 'driver') {
            $dataArray['healthBookFile'] = FileLoad::where('path', 'driver/health_book')
                ->where('new_name', $user->workingData->id . '.' . $user->workingData->health_book_doctype)
                ->first();

            $dataArray['drivingLicenseFile'] = FileLoad::where('path', 'driver/driving_license')
                ->where('new_name', $user->workingData->id . '.' . $user->workingData->driving_license_doctype)
                ->first();
        }

        $dataArray['user'] = $user;
        $dataArray['exceptions'] = ExceptionType::all('id', 'name');
        return view('user.user-page', $dataArray);
    }

    public function showChangeTempPasswordForm()
    {
        return view('auth.passwords.change-temp-password');
    }

    public function changeTempPassword(ChangePasswordRequest $request)
    {
        $user = \auth()->user();
        $user->password = Hash::make($request->password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        Auth::guard()->login($user);

        return redirect()->route('user-board');
    }

    public function destroy($id)
    {
        UserWorkingData::where('user_id', $id)->where('workspace_id', Workspace::current())->delete();

        return redirect()->route('user-board');
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function sendPassword(Request $request)
    {
        Mail::to($request->email)->send(new SendPasswordEmail($request->password));

        return response('OK');
    }

    public function updateOnboarding(UpdateOnboardingRequest $request)
    {
        Auth::user()->updateOnboarding($request->validated());

        return response('OK');
    }
}
