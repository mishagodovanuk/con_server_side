<?php

namespace App\Http\Requests\Transport;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class TruckWithoutTrailer extends FormRequest
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
                File::types(['png', 'jpeg', 'jpg', 'gif'])
                    ->max(800)
            ],
            'mark' => 'required',
            'model' => 'required',
            'category' => 'required',
            'type' => 'required',
            //'license_plate'=> ['required_if:registration_country,1', 'regex:/[АВСЕНІКМОРТХABCEHIKMOPTX]{2}\d{4}[АВСЕНІКМОРТХABCEHIKMOPTX]{2}/i'],
            'license_plate' => 'required',
            'registration_country' => 'required',
            'manufacture_year' => 'required|digits:4',
            'company' => 'required',
            'driver' => 'required',
            'spending_empty' => 'required|numeric',
            'spending_full' => 'required|numeric'
        ];
    }
}
