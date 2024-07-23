<?php

namespace App\Http\Requests\Auth;

use App\Traits\CheckEmailTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordRequest extends FormRequest
{

    use CheckEmailTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->existsEmail($this)) {
            $rules['login'] = 'required|email|exists:users,email';
        } else {
            $rules['login'] = 'required|exists:users,phone|min:13';
        }

        return $rules;
    }
}
