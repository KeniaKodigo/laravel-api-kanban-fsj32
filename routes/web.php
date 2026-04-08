<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

# creando nuestra primera ruta
Route::get('/mensaje/saludo', function () {
    echo "Hola, nuestra primera ruta";
});

# creando una ruta para el metodo de TaskController
Route::get('/message_task', [TaskController::class, 'imprimirMensaje']);