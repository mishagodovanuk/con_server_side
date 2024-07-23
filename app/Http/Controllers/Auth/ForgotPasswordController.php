<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\SendVerificationCode;
use App\Traits\VerificationCodeTrait;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use VerificationCodeTrait;

    public function sendVerificationCode(ForgotPasswordRequest $request)
    {
        $this->dispatch(new SendVerificationCode($request->validated()));

        return response('Code successfully send');
    }
}
