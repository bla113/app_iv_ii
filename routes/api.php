<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\MateriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout.user.app')->middleware('auth:sanctum');

});
Route::controller(MateriaController::class)->group(function () {
 
    Route::post('materias', 'show')->name('materias')->middleware('auth:sanctum');
    Route::post('pendientes', 'pendientes')->name('pendientes')->middleware('auth:sanctum');

});

