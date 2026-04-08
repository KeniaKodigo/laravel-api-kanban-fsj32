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


