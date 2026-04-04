<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::get('/projects/{project:slug}', [ProjectApiController::class, 'show']);
});
