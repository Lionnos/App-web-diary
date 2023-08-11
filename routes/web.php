<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CityController;

Route::get('/', [IndexController::class, 'actionIndex']);

Route::get('city/getall', [CityController::class, 'actionGetAll']);
Route::match(['get', 'post'], 'city/insert', [CityController::class, 'actionInsert']);
Route::get('city/delete/{idCity}', [CityController::class, 'actionDelete']);
Route::match(['get', 'post'], 'city/update/{idCity}', [CityController::class, 'actionUpdate']);