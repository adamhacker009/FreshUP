<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmissionUploadController;

Route::get('/api/emissions', [EmissionUploadController::class, 'getLatestEmissions']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/upload-emissions', [EmissionUploadController::class, 'upload']);
});

Route::post('/login', [UserController::class, 'login']);

