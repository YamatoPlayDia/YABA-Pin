<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/profiles', ProfileController::class);
// 以下のものはapiResourceでまとめられるらしい
// Route::get('/profiles', [ProfileController::class, 'index']);
// Route::get('/profiles/{id}', [ProfileController::class, 'show']);
// Route::post('/profiles', [ProfileController::class, 'store']);
// Route::put('/profiles/{id}', [ProfileController::class, 'update']);
// Route::delete('/profiles/{id}', [ProfileController::class, 'destroy']);

