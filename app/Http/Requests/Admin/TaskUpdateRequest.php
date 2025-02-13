<?php

namespace App\Http\Requests\Admin;

use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|min:3|max:80',
            'status' => ['sometimes', Rule::enum(TaskStatusEnum::class)],
        ];
    }

    public function updateTask()
    {dd($task = $this->route('task'));
        return DB::transaction(function() {
            $this->task->update([
                'title' => $this->exists('title') ? $this->title : $this->task->title,
                'status' => $this->exists('status') ? $this->status : $this->task->status,
                'user_id' => $this->task->user_id,
            ]);

            return $this->task->refresh();
        });
    }
}
