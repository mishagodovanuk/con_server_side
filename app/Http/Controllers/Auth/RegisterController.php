<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendVerificationCode;
use App\Models\VerificationCodes;
use App\Models\User;
use App\Traits\CheckEmailTrait;
use App\Traits\VerificationCodeTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use CheckEmailTrait;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \App\Models\User
     */
    public function create(Request $request)
    {
        $login = $request->get('login');

        $data['password'] = Hash::make($request->get('password'));

        if ($this->existsEmail($request)) {
            $data['email'] = $login;
        } else {
            $data['phone'] = $login;
        }

        return User::create($data);
    }

    public function register(RegisterRequest $request)
    {
        $code = $request->get('code');

        $codeObj = VerificationCodes::where('login', $request->get('login'))
            ->where('code', $code)
            ->first();
        if (!$codeObj) {
            return response()->json(['message' => 'Wrong code!'], 422);
        }

        event(new Registered($user = $this->create($request)));

        VerificationCodes::where('login', $request->get('login'))->delete();

        Auth::guard()->login($user);

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->route('onboarding');
    }

    public function sendVerificationCode(RegisterRequest $request)
    {
        $this->dispatch(new SendVerificationCode($request->validated()));

        return response('Code successfully sent');
    }
}
