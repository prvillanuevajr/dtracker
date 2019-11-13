<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/diagnose', 'DiagnoseController@index');
    Route::post('/diagnose/get_symptoms_all', 'DiagnoseController@symptoms');
    Route::post('/diagnose/get_diagnosis', 'DiagnoseController@get_diagnosis');
    Route::get('/diagnose/diagnosis/{diagnosis}', 'DiagnoseController@show');
});
