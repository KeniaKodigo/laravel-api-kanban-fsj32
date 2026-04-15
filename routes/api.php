<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


# Las rutas de tipo api (siempre llevan "/api" en las url)
# http://127.0.0.1:8000/api/messages
Route::get('/messages', [TaskController::class, 'imprimirMensaje']);
Route::get('/users', [TestController::class, 'getUsers']);

# ------------------------ RUTAS DE LAS TAREAS ----------------------
Route::get('/v1/tasks', [TaskController::class, 'index']);
Route::post('/v1/tasks', [TaskController::class, 'store']);
# ruta con parametro
Route::get('/v1/tasks/{taskId}', [TaskController::class, 'show']);
Route::patch('/v1/tasks/{taskId}', [TaskController::class, 'update']);


// peticiones HTTP: GET, PUT, DELETE, POST, PATCH
// crear un nuevo recurso (POST)
// obtener datos de un recurso (GET)
// actualizar TODA la informacion del recurso (PUT)
// actualizar UNA PARTE DE la informacion del recurso (PATCH)
// eliminar un recurso (DELETE)