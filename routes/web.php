<?php

use App\Http\Controllers\CitasController;
use App\Http\Controllers\AgendadosController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

//Citas
Route::post('/citas/create', 'App\Http\Controllers\CitasController@create')->name('citas.create');

Route::put('/citas{id}', 'App\Http\Controllers\CitasController@update')->name('citas.update');

Route::get('/citas', [CitasController::class, 'index'])->name('citas.index');

Route::delete('/citas{id}', [CitasController::class, 'destroy'])->name('citas.destroy');



//Agendados
Route::get('/agendados', [AgendadosController::class, 'index'])->name('agendados.index');



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
