<?php

use App\Http\Controllers\AsientoContableController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::resource('asientos', AsientoContableController::class);
Route::resource('proveedores', ProveedorController::class)->parameters([
    'proveedores' => 'proveedor',
]);
Route::resource('clientes', ClienteController::class);

Route::get('/', function () {
    return view('welcome');
});
