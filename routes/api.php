<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'krama'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/get-data-krama', 'KramaController@getKrama');
});

Route::group(['prefix' => 'presensi'], function () {
    Route::get('/get', 'PresensiController@get');
    Route::post('/detail', 'PresensiController@detail');
    Route::post('/create', 'PresensiController@create');
    Route::post('/fill-presensi', 'PresensiController@fillPresensi');
    Route::get('/open-presensi', 'PresensiController@openClosePresensi');
    Route::get('/get-open', 'PresensiController@getOpen');
    Route::get('/get-open-krama', 'PresensiController@getOpenKrama');
    Route::get('/get-filled', 'PresensiController@getFilledPresensi');
});


Route::group(['prefix' => 'kegiatan'], function () {
    Route::get('/get', 'KegiatanController@get');
    Route::post('/edit', 'KegiatanController@edit');
    Route::get('/detail', 'KegiatanController@detail');
    Route::post('/create', 'KegiatanController@create');
});


