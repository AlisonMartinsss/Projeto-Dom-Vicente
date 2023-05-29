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

Auth::routes();
Route::resource('espelho', 'App\Http\Controllers\EspelhoController');
Route::resource('lancamento', 'App\Http\Controllers\LancamentoController');
Route::resource('demonstrativo', 'App\Http\Controllers\DemonstrativoController');
