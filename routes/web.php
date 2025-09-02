<?php

use App\Http\Controllers\AsientoContableController;
use Illuminate\Support\Facades\Route;

Route::resource('asientos', AsientoContableController::class);

Route::get('/', function () {
    return view('welcome');
});
