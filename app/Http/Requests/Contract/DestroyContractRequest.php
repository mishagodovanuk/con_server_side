<?php

namespace App\Http\Requests\Contract;

use App\Http\Requests\RequestJson;
use App\Models\TransportPlanningToStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;


class DestroyContractRequest extends FormRequest
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
        $rules['contract'] = [ 'integer', 'exists:contracts,id' ];

        return $rules;
    }
}
