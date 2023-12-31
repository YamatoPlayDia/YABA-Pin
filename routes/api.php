<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\FootprintController;
use App\Http\Controllers\MessageController;


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

Route::apiResource('spots', SpotController::class);
Route::apiResource('footprints', FootprintController::class);
Route::apiResource('messages', MessageController::class);

Route::get('/spots/one/{dataName}/{uniqueData}', [SpotController::class, 'getOneByData']);
Route::get('/spots/multi/{dataName}/{Data}', [SpotController::class, 'getMultiByData']);
Route::get('/footprints/one/{dataName}/{uniqueData}', [FootprintController::class, 'getOneByData']);
Route::get('/footprints/multi/{dataName}/{Data}', [FootprintController::class, 'getMultiByData']);
Route::get('/messages/one/{dataName}/{uniqueData}', [MessageController::class, 'getOneByData']);
Route::get('/messages/multi/{dataName}/{Data}', [MessageController::class, 'getMultiByData']);
