<?php

namespace App\Http\Requests\Warehouse;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;

class MainDataRequest extends FormRequest
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
            'name' => 'required|string',
            'country' => 'required',
            'settlement' => 'required',
            'street' => 'required',
            'building_number' => 'required|string',
            'user' => 'required',
            'company' => 'required',
            'type' => 'required',
            'warehouse_erp' => 'required'
        ];
    }
}
