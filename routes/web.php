<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArrayController;

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

Route::get('/', [ArrayController::class, 'index']);

Route::controller(\App\Http\Controllers\ArrayController::class)->group(function () {
    Route::get('/array', 'sortedArray');
    Route::get('/array/download', 'downloadArray');
    Route::get('/array/write', 'writeToDB');
});
