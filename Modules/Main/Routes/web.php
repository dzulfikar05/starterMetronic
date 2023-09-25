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

Route::controller(MainController::class)->middleware("auth")->group(function() {
    // Route::get('/','index')->name('/');
    Route::post('/main/getPage','getPage')->name('main/getPage');
});