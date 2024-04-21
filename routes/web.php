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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('om', 'QuotationController');
Route::post('update_om/{id}', 'QuotationController@update');
Route::post('delete_om/{id}', 'QuotationController@destroy');

Route::resource('earth', 'EarthQuotationController');
Route::post('update_earth/{id}', 'EarthQuotationController@update');

Route::resource('exercises', 'ExercisesController1');
