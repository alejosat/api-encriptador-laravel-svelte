<?php

use App\Http\Controllers\Api\EncryptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/encrypt', [EncryptController::class, 'encrypt']);
Route::post('/decrypt', [EncryptController::class, 'decrypt']);
