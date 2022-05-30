<?php

use App\Http\Controllers\ForestTrainController;
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
// axios alapok példa:
Route::get('/learn', function () {
    return view('welcome');
});

// kisvasút:
Route::get('/', [ForestTrainController::class, 'index']);
Route::get('/onstation/{id}', [ForestTrainController::class, 'onstation']);
Route::get('/stations', [ForestTrainController::class, 'stations']);
