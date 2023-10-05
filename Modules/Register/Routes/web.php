<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(RegisterController::class)->middleware('guest')->group(function() {
    Route::get('/register','index')->name('register');
});
Route::controller(RegisterController::class)->group(function() {
    Route::post('/register/store','store')->name('register/store');
});