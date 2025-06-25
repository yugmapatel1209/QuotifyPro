<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, QuotationController, ExercisesController1};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('om', QuotationController::class);

Route::post('update_om/{id}', [QuotationController::class, 'update']);
Route::post('delete_om/{id}', [QuotationController::class, 'destroy']);

// Route::resource('earth', EarthQuotationController::class);
// Route::post('update_earth/{id}', [EarthQuotationController::class, 'update']);

Route::resource('exercises', ExercisesController1::class);
