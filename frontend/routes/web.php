<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

// Redirigir la página principal al listado de productos
Route::get('/', function () {
    return redirect()->route('productos.index');
});

// Rutas del CRUD (Laravel las genera automáticamente con resource)
Route::resource('productos', ProductoController::class);