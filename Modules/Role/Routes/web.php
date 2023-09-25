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
;
Route::controller(RoleController::class)->middleware('auth', 'access')->group(function() {
    Route::get('/role','index')->name('role');
    Route::get('/role/table','initTable')->name('role/table');
    Route::post('/role/store','store')->name('role/store');
    Route::post('/role/edit','edit')->name('role/edit');
    Route::post('/role/update','update')->name('role/update');
    Route::post('/role/destroy','destroy')->name('role/destroy');
    Route::post('/role/show','show')->name('role/show');
    Route::post('/role/saveRole','saveRole')->name('role/saveRole');
    Route::post('/role/combobox','combobox')->name('role/combobox');
});