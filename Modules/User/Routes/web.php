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

Route::controller(UserController::class)->middleware('auth', 'access')->group(function() {
    Route::get('/user','index')->name('user');
    Route::get('/user/table','initTable')->name('user/table');
    Route::post('/user/store','store')->name('user/store');
    Route::post('/user/edit','edit')->name('user/edit');
    Route::post('/user/update','update')->name('user/update');
    Route::post('/user/destroy','destroy')->name('user/destroy');
});