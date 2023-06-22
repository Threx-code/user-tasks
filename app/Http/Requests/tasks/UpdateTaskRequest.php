<?php

namespace App\Http\Requests\tasks;

use App\Helpers\TaskHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
        $taskId = request()->input('task_id');
        $projectId = request()->input('project_id');

        return [
            'name' => ['required', 'string', Rule::unique('tasks', 'name')->where('project_id', $projectId)->ignore($taskId)],
            'priority' => ['nullable', Rule::in(TaskHelper::PRIORITIES)],
            'project_id' => ['required', Rule::exists('projects', 'id')]
        ];
    }
}
