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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('App\Http\Controllers')->middleware('cek.apikey')->group(function () {

    Route::get('login', 'PegawaiController@login');
    Route::delete('login', 'PegawaiController@logout');

    Route::group(['prefix' => 'pegawai', 'middleware' => ['cek.user']], function () {
        Route::patch('/', 'PegawaiController@update');
        Route::post('/photo', 'PegawaiController@simpan_photo');
        Route::get('/photo', 'PegawaiController@photo');
    });
});