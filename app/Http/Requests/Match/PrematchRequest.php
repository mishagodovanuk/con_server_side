<?php

namespace App\Http\Requests\Match;

use App\Enums\Match\ConsolidationStatus;
use App\Enums\Match\ConsolidationType;
use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrematchRequest extends FormRequest
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
            'members' => 'required|integer',
            'transport_planning_id' => 'required_if:transport_planning_ids,null|integer',
            'transport_planning_ids' => 'required_if:transport_planning_id,null|array',
            'pallets_available' => 'required|integer',
            'pallets_booked' => 'required|integer',
            'weight_available' => 'required|integer',
            'weight_booked' => 'required|integer',
            'comment' => 'string|max:300',
            'type' => ['required', Rule::enum(ConsolidationType::class)],
            'cargo_types' => 'required|array',
            'goods_invoices' => 'required_if:transport_planning_ids,null|array',
            'cargo_request_id' => 'required_if:transport_planning_id,null|integer',
            'status' => [Rule::enum(ConsolidationStatus::class)],
        ];
    }
}
