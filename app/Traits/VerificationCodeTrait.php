<?php

namespace App\Traits;

use App\Mail\VerificationCodeMail;
use App\Models\VerificationCodes;
use App\Services\API\TurboSms;
use Illuminate\Support\Facades\Mail;

trait VerificationCodeTrait
{

    use CheckEmailTrait;

    public function sendCode($request)
    {
        $code = rand(1000, 9999);
        $login = $request['login'];

        VerificationCodes::where('login', $login)->delete();

        if ($this->existsEmail($request)) {
            Mail::to($login)->send(new VerificationCodeMail($code));
        } else {
            TurboSms::sendSms([$login], $code);
        }

        VerificationCodes::create([
            'login' => $login,
            'code' => $code
        ]);
    }
}
