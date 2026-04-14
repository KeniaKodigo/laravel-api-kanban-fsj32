<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //controlador que va tener todas las acciones de las tareas


    public function imprimirMensaje(){
        echo "Estamos en el controlador de las tareas";
    }

    // metodo para crear una nueva tarea
    public function store(StoreTaskRequest $request){
        
        //insert into table(campos) values() -> create()
        Task::create($request->all());
        // 201 => representa cuando se registro algo de manera correcta
        return response()->json(["message" => "Tarea creada correctamente"], 201);
    }
}
