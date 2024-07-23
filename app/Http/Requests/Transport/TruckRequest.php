<?php

namespace App\Http\Requests\Transport;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class TruckRequest extends FormRequest
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
            'image' => ['nullable',
                File::types(['png', 'jpeg', 'jpg','gif'])
                    ->max(800)
            ],
            'mark'=>'required',
            'model'=>'required',
            'category'=>'required',
            'type'=>'required',
           // 'license_plate'=> ['required_if:registration_country,1', 'regex:/[АВСЕНІКМОРТХABCEHIKMOPTX]{2}\d{4}[АВСЕНІКМОРТХABCEHIKMOPTX]{2}/i'],
            'license_plate' => 'required',
            'registration_country'=>'required',
            'download_methods'=>'required',
            'manufacture_year'=>'required|digits:4',
            'company' => 'required',
            'driver' => 'required',
            'length' =>'required|numeric',
            'width' => 'required|numeric',
            'height' =>'required|numeric',
            'volume' =>'required|numeric',
            'weight'=>'required|numeric',
            'capacity_eu' =>'required|integer',
            'capacity_am' =>'required|integer',
            'spending_empty'=>'required|numeric',
            'spending_full' => 'required|numeric',
            'carrying_capacity' => 'required|numeric',
        ];
    }
}
