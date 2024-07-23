<?php

namespace App\Http\Requests\TransportPlanning;

use App\Http\Requests\RequestJson;
use App\Models\TransportPlanningToStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;


class DestroyStatusRequest extends FormRequest
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
        $rules['status'] = [ 'integer', 'exists:transport_planning_to_statuses,id' ];

        return $rules;
    }
}
