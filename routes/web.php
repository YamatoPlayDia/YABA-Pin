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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ログインからダッシュボード
Route::get('/top_logo', function () {
    return view('top_logo');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// 投げる
Route::get('/message_insert', function (){
    return view('message_insert');
})->middleware(['auth', 'verified'])->name('message_insert');

Route::get('/map_throw', function () {
    return view('map_throw');
})->middleware(['auth', 'verified'])->name('map_throw');

Route::get('/throwing', function (){
    return view('throwing');
})->middleware(['auth', 'verified'])->name('throwing');
Route::get('/thrown', function (){
    return view('thrown');
})->middleware(['auth', 'verified'])->name('thrown');

// 読む
Route::get('/map_read', function () {
    return view('map_read');
})->middleware(['auth', 'verified'])->name('map_read');
Route::get('/reading_view', function (){
    return view('reading_view');
})->middleware(['auth', 'verified'])->name('reading_view');
Route::get('/burning', function (){
    return view('burning');
})->middleware(['auth', 'verified'])->name('burning');
Route::get('/burned', function (){
    return view('burned');
})->middleware(['auth', 'verified'])->name('burned');;


// 設定用
Route::get('/create-spot', function () {
    return view('create_spot');
});

Route::get('/top_logo', function (){
    return view('top_logo');
})->name('top_logo');

require __DIR__.'/auth.php';
