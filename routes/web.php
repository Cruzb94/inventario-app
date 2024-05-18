<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\OperariosController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\TallersController;
use App\Http\Controllers\CuentaBancosController;




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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('productos', ProductosController::class);
Route::resource('operarios', OperariosController::class);
Route::resource('entradas', EntradasController::class);
Route::resource('salidas', SalidasController::class);
Route::resource('tallers', TallersController::class);
Route::resource('ingresos', IngresosController::class);
Route::resource('cuentabancos', CuentaBancosController::class);

Route::get('/obtener-descripcion/{id}', [ProductosController::class, 'obtenerDescripcion']);
