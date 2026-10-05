<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OperationController;
use App\Http\Controllers\Api\LogisticsItemController;
use App\Http\Controllers\Api\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes using Sanctum middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'currentUser']);

    Route::apiResource('/items', LogisticsItemController::class);
    // Add this route right here for item status updates:
    Route::patch('/items/{id}/status', [LogisticsItemController::class, 'updateStatus']);

    Route::apiResource('/operations', OperationController::class);
    Route::patch('/operations/{operation}/status', [OperationController::class, 'updateStatus']);

    Route::get('/dashboard', [DashboardController::class, 'summary']);
});
