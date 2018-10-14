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

Route::get('/calculation', function () {
    return view('calculationconverter');
});

Route::get('/convertedintegers', function () {
    return view('convertedintegers');
});

Route::get('/conversions', function () {
    return view('conversions');
});

Route::get('/topten', function () {
    return view('top10integers');
});

Route::get('/conversions', 'NumeralsConverterController@lastConversions');
Route::get('/top10integers', 'NumeralsConverterController@topTen');
Route::post('/calculationconverter/search', 'NumeralsConverterController@index');
