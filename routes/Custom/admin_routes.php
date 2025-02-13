<?php

namespace routes\Custom;

use App\Http\Controllers\Admin\TaskMangerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('tasks', TaskMangerController::class)->scoped()->except('show');
});