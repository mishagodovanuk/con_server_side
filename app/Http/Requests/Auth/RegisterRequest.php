<?php

namespace App\Http\Requests\Auth;

use App\Traits\CheckEmailTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{

    use CheckEmailTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = ['password' => ['required', 'confirmed', 'string', Password::min(8)
            ->numbers()
        ]];
        if ($this->existsEmail($this)) {
            $rules['login'] = 'required|email|unique:users,email';
        } else {
            $rules['login'] = 'required|unique:users,phone|min:13';
        }

        return $rules;
    }
}
