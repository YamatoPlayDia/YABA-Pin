<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/top_logo', function () {
    return view('top_logo');
});


Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/map_read', function () {
    return view('map_read');
})->middleware(['auth', 'verified'])->name('map_read');
Route::get('/map_throw', function () {
    return view('map_throw');
})->middleware(['auth', 'verified'])->name('map_throw');

Route::get('/create-spot', function () {
    return view('create_spot');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 画面確認用
Route::get('/thrown', function (){
    return view('thrown');
});

Route::get('/message_insert', function (){
    return view('message_insert');
})->middleware(['auth'])->name('message_insert');

Route::get('/burned', function (){
    return view('burned');
});
Route::get('/burning', function (){
    return view('burning');
});
Route::get('/throwing', function (){
    return view('throwing');
});

require __DIR__.'/auth.php';
