<?php

use App\Http\Controllers\AsientoContableController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::resource('asientos', AsientoContableController::class);
Route::resource('proveedores', ProveedorController::class)->parameters([
    'proveedores' => 'proveedor',
]);
Route::resource('clientes', ClienteController::class);
Route::resource('productos', ProductoController::class)->parameters([
    'productos' => 'producto',
]);

Route::get('/', function () {
    return view('welcome');
});
