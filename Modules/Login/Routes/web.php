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

Route::controller(LoginController::class)->middleware('guest')->group(function() {
    Route::get('/login','index')->name('login');
});
Route::controller(LoginController::class)->group(function() {
    // Route::get('/login','index')->name('login');
    Route::post('/login/authentication','authentication')->name('login/authentication');
    Route::post('/login/logout', 'logout')->name(('login/logout'));
});