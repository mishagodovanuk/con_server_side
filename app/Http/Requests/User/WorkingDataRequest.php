<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;


class WorkingDataRequest extends FormRequest
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
            'position' => 'required|string',
            'role' => 'required',
            'company_id' => 'required|numeric',
            'health_book_number' => 'required_if:position,driver|numeric|digits_between:4,20',
            'driver_license_date' => 'required_if:position,driver|date',
            'health_book_date' => 'required_if:position,driver|date',
            'driving_license' => [new RequiredIf($this->position == 'driver' && $this->need_file == 'true')],
            'driving_license_number' => ['required_if:position,driver', 'size:9', 'regex:/[АВСЕНІКМОРТХABCEHIKMOPTX]{3}\d{6}/i'],
            'health_book' => [new RequiredIf($this->position == 'driver' && $this->need_file == 'true')],
        ];
    }
}
