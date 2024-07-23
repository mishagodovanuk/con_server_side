<?php

namespace App\Http\Requests\Goods;

use App\Http\Requests\RequestJson;
use App\Models\TransportPlanningToStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;


class CreateUpdateGoodsRequest extends FormRequest
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
            'name' => [ 'required', 'string' ],
            'company_id' => [ 'required', 'exists:companies,id,deleted_at,NULL' ],
            'party' => [ 'required', 'date' ],
            'cargo_type_id' => [ 'required', 'exists:cargo_types,id' ],
            'category_id' => [ 'required', 'exists:sku_categories,id' ],
            'manufacturer_id' => [ 'required', 'exists:companies,id,deleted_at,NULL' ],
            'manufacturer_country_id' => [ 'required', 'exists:countries,id' ],
            'adr_id' => [ 'required', 'exists:adrs,id' ],
            'measurement_unit_id' => [ 'required', 'exists:measurement_units,id' ],
            'comment' => [ 'nullable', 'string' ],
            'weight_netto' => [ 'required', 'decimal:0,1' ],
            'weight_brutto' => [ 'required', 'decimal:0,1' ],
            'temp_from' => [ 'required', 'decimal:0,1' ],
            'temp_to' => [ 'required', 'decimal:0,1' ],
            'height' => [ 'required', 'decimal:0,1' ],
            'width' => [ 'required', 'decimal:0,1' ],
            'depth' => [ 'required', 'decimal:0,1'  ],

            'packages' => [ 'required', 'array' ],
            'packages.*' => [  'required_array_keys:type_id,number,weight,weight_netto,weight_brutto,height,width,depth' ],
            'packages.*.type_id' => [ 'required', 'integer', 'exists:package_types,id' ],
            'packages.*.number' => [ 'required', 'integer' ],
            'packages.*.packingSetMain' => [ 'nullable' ],
            'packages.*.weight' => [ 'nullable', 'decimal:0,1' ],
            'packages.*.weight_netto' => [ 'nullable', 'decimal:0,1' ],
            'packages.*.weight_brutto' => [ 'nullable', 'decimal:0,1' ],
            'packages.*.height' => [ 'nullable', 'decimal:0,1' ],
            'barcodes.*.width' => [ 'nullable', 'decimal:0,1' ],
            'packages.*.depth' => [ 'nullable', 'decimal:0,1' ],

            'barcodes' => [ 'nullable', 'array' ],
            'barcodes.*' => [ 'required', 'string' ],
        ];

        return $rules;
    }
}
