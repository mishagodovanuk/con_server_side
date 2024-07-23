<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class BookmarkRequest extends FormRequest
{
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
            'name'=>'required|string|max:80',
            'key'=>'required|string|max:80',
            'page_uri' => 'required|string',
            'properties' => 'string|nullable|max:10000',
            'html_id' => 'nullable|string|max:100'
        ];
    }
}
