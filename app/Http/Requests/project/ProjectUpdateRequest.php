<?php

namespace App\Http\Requests\project;

use App\Helpers\TaskHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectUpdateRequest extends FormRequest
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
        $projectId = request()->input('product_id');
        return [
            'name' => ['required', 'string', Rule::unique('projects', 'name')->where('id', $projectId)->ignore($projectId)],
        ];
    }
}
