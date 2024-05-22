<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\OperariosController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\TallersController;
use App\Http\Controllers\CuentaBancosController;
use App\Http\Controllers\UserController;




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

Route::resource('productos', ProductosController::class)->except([
    'destroy' 
]);
Route::delete('productos/{producto}', [ProductosController::class, 'destroy'])
    ->name('productos.destroy')
    ->middleware('admin'); 


Route::resource('operarios', OperariosController::class)->except([
    'destroy' 
]);

Route::delete('operarios/{operario}', [OperariosController::class, 'destroy'])
    ->name('operarios.destroy')
    ->middleware('admin'); 




Route::resource('entradas', EntradasController::class)->except([
    'destroy' 
]);

Route::delete('entradas/{entrada}', [EntradasController::class, 'destroy'])
    ->name('entradas.destroy')
    ->middleware('admin'); 



Route::resource('salidas', SalidasController::class)->except([
    'destroy' 
]);

Route::delete('salidas/{salida}', [SalidasController::class, 'destroy'])
    ->name('salidas.destroy')
    ->middleware('admin'); 



Route::resource('tallers', TallersController::class)->except([
    'destroy' 
]);

Route::delete('tallers/{taller}', [TallersController::class, 'destroy'])
    ->name('tallers.destroy')
    ->middleware('admin'); 





Route::resource('ingresos', IngresosController::class)->middleware('admin');



Route::resource('cuentabancos', CuentaBancosController::class)->except([
    'destroy' 
]);

Route::delete('cuentabancos/{cuentabanco}', [CuentaBancosController::class, 'destroy'])
    ->name('cuentabancos.destroy')
    ->middleware('admin'); 


Route::resource('users', UserController::class)->middleware('admin');

Route::get('/obtener-descripcion/{id}', [ProductosController::class, 'obtenerDescripcion']);
