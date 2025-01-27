<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class PasswordRequest extends FormRequest
{

    use RequestJson;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //'login' => 'required|string|max:50',
            'password' => ['required', 'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'new_password' => ['required', 'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
            'confirm_password' => 'required|same:new_password'
        ];
    }

}
