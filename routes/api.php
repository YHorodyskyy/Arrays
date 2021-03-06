<?php

use App\Http\Controllers\ArrayController;
use App\Http\Controllers\CrowdinAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ArrayController::class)->group(function () {
    Route::get('/array', 'sortedArray')->name('array.index');
    Route::get('/array/download', 'downloadArray')->name('array.download.current');
    Route::get('/array/download/{arraySort}', 'downloadByID')->name('array.download');
    Route::get('/array/write', 'writeToDB')->name('array.write');
});

Route::controller(CrowdinAPIController::class)->group(function () {
    Route::get('/manifest.json', "manifest");
    Route::post('/install', "install");
    Route::post('/uninstall', "uninstall");
});
