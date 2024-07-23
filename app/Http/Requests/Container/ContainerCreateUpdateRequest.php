<?php

namespace App\Http\Requests\Container;

use App\Http\Requests\RequestJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ContainerCreateUpdateRequest extends FormRequest
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
        $rules = [
            'name'=>'required',
            'uniq_id'=>'required',
            'company_id'=>'required|exists:companies,id',
            'type_id'=>'required|exists:container_types,id',
            'reversible'=>'nullable|boolean',
            'comment' => 'nullable|string',
            'weight' =>'nullable|numeric',
            'height' =>'nullable|numeric',
            'width' =>'nullable|numeric',
            'depth' =>'nullable|numeric',
            'is_draft' =>'nullable|boolean',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
