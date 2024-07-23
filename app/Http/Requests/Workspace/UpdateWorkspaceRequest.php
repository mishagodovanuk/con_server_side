<?php

namespace App\Http\Requests\Workspace;

use App\Http\Requests\RequestJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;


class UpdateWorkspaceRequest extends FormRequest
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
            'workspace' => [ 'integer', 'exists:workspaces,id,deleted_at,NULL' ],
        ];
    }
}
