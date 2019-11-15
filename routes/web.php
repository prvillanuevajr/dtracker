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

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/diagnose', 'DiagnoseController@index');
    Route::post('/diagnose/get_symptoms_all', 'DiagnoseController@symptoms');
    Route::post('/diagnose/get_diagnosis', 'DiagnoseController@get_diagnosis');
    Route::get('/diagnose/diagnosis/{diagnosis}', 'DiagnoseController@show');
    Route::post('/diagnose/diagnosis/getAllDiagnosis', 'DiagnoseController@getAllDiagnosis');

    Route::post('/analytics/analytics-1', 'AnalyticsController@analytics_1');
    Route::post('/analytics/analytics-2', 'AnalyticsController@analytics_2');
    Route::post('/analytics/analytics-3', 'AnalyticsController@analytics_3');
    Route::post('/analytics/analytics-4', 'AnalyticsController@analytics_4');

    Route::get('/my-account', 'UserController@show');
});
Route::get('test', function () {
//    return array_values(array_unique(explode(' ',strtolower(implode(' ',\Illuminate\Support\Facades\DB::table('symptoms')->pluck('name')->toArray())))));
    return json_decode(file_get_contents("../composer.json"),true);
});