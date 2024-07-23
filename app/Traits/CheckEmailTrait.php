<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait CheckEmailTrait
{
    private function existsEmail($request)
    {
        $login = $request['login'];

        $validator = Validator::make(['email' => $login],[
            'email' => 'required|email'
        ]);

        return $validator->passes();
    }
}
