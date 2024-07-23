<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivateDataRequest extends FormRequest
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
            'email' => 'required|email',
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'patronymic' => 'required|string|max:50',
            'birthday' => 'required|date',
            'phone' => 'required|string|size:13'
        ];
    }
}
