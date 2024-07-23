<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\RequestJson;

use Illuminate\Foundation\Http\FormRequest;

class PhysicalCompanyRequest extends FormRequest
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
            'firstName' => 'required|string|max:15',
            'lastName' => 'required|string|max:15',
            'patronymic' => 'required|string|max:20',
            'ipn' => 'required|digits:10',
            'country' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'street' => 'required|string|max:80',
            'building_number' => 'required',
            'gln' => 'required|digits:13',
            'bank' => 'required|string',
            'iban' => 'required|string|size:29',
            'mfo' => 'required|digits:6',
            'currency' => 'required|string|max:5',
            'about' =>'required|string|max:500'
        ];
    }

}
