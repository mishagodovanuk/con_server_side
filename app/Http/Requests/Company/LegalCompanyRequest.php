<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;


class LegalCompanyRequest extends FormRequest
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
            'edrpou' => 'required|string|max:15',
            'company_name' => 'required|string|max:35',
            'legal_entity' => 'required|string|max:20',
            'ipn' => 'nullable|integer|digits:10',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'building_number' => 'required',
            'gln' => 'required|digits:13',
            'u_country' => 'required',
            'u_city' => 'required',
            'u_street' => 'required',
            'u_building_number' => 'required',
            'u_gln' => 'required|digits:13',
            'bank' => 'required|string',
            'iban' => 'required|string|size:29',
            'mfo' => 'required|digits:6',
            'currency' => 'required|string|max:5',
            'about'=>'required|string|max:500',
            'ust_doc' => 'nullable|file',
            'registration_doc' => 'nullable|file',
        ];
    }

}
