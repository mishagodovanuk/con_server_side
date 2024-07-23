<?php

namespace App\Http\Requests\Transport;

use App\Http\Requests\RequestJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;
class EquipmentRequest extends FormRequest
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
            'type'=>'required',
        //    'license_plate'=> ['required_if:registration_country,1', 'regex:/[АВСЕНІКМОРТХABCEHIKMOPTX]{2}\d{4}[АВСЕНІКМОРТХABCEHIKMOPTX]{2}/i'],
            'license_plate' => 'required',
            'registration_country'=>'required',
            'download_methods'=>'required',
            'manufacture_year'=>'required|digits:4',
            'company' => 'required',
            'transport' => 'required',
            'length' =>'required|numeric',
            'width' => 'required|numeric',
            'height' =>'required|numeric',
            'volume' =>'required|numeric',
            'capacity_eu' =>'required|integer',
            'capacity_am' =>'required|integer',
            'carrying_capacity' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
