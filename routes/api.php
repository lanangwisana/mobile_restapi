<?php

use App\Http\Controllers\Api\PresensiApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('sekolah', 'App\Http\Controllers\Api\SekolahController');

Route::apiResource('presensis', PresensiApiController::class);
