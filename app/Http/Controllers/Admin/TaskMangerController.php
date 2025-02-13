<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskStoreRequest;
use App\Http\Requests\Admin\TaskUpdateRequest;
use App\Http\Resources\Admin\TasksResource;
use App\Models\TaskManger;

class TaskMangerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = TaskManger::all();
        return response([
            'tasks' => TasksResource::collection($tasks)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = $request->storeTask();
        return response([
            'message' => __('tasks.store'),
            'task' => new TasksResource($task)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, TaskManger $task)
    {
        $task = $request->updateTask();
        return response([
            'message' => __('tasks.update'),
            'task' => new TasksResource($task)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskManger $task)
    {
        $message = $task->remove();
        return response($message);
    }
}
