<?php

namespace App\Http\Requests\Admin;

use App\Enums\TaskStatusEnum;
use App\Models\TaskManger;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TaskStoreRequest extends FormRequest
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
            'title' => 'required|string|unique:tasks,title|min:3|max:80',
            'status' => ['required', Rule::enum(TaskStatusEnum::class)],
        ];
    }

    public function storeTask()
    {
        return DB::transaction(function() {
            $task = TaskManger::create([
                'title' => $this->title,
                'status' => $this->status,
                'user_id' => $this->user()->id ?? 1,
            ]);
            return $task->refresh();
        });
    }
}
