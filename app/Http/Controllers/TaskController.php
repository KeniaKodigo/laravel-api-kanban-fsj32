<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //controlador que va tener todas las acciones de las tareas


    public function imprimirMensaje(){
        echo "Estamos en el controlador de las tareas";
    }

    // metodo para obtener todas las tareas
    public function index(){
        // select tasks.id, tasks.title, tasks.description, tasks.status, tasks.priority, tasks.due_date, tasks.user_id, users.name as user from tasks inner join users on tasks.user_id = users.id

        $array_tasks = Task::select('tasks.id', 'tasks.title', 'tasks.description', 'tasks.status', 'tasks.priority', 'tasks.due_date', 'tasks.user_id', 'users.name as user')
        ->join('users','tasks.user_id', '=', 'users.id')
        ->get();
        return response()->json($array_tasks, 200);
    }

    // metodo para crear una nueva tarea
    public function store(StoreTaskRequest $request){
        
        //insert into table(campos) values() -> create()
        Task::create($request->all());
        // 201 => representa cuando se registro algo de manera correcta
        return response()->json(["message" => "Tarea creada correctamente"], 201);
    }

    // metodo para obtener una tarea en especifico
    public function show($taskId){
        // select id, title from tasks where id = 2
        $task = Task::find($taskId);
        //$task = Task::select('id','title')->where('id',$taskId)->get();

        if($task){
            return response()->json($task, 200);
        }

        // si no se encontro la tarea
        return response()->json(["message" => "No se encontro la tarea"], 404);

    }

    // metodo para actualizar los datos de la tarea
    public function update(UpdateTaskRequest $request, $taskId){
        // update tasks set title = 'dato 1', description = 'dato 2', due_date = '2026-02-25' where id = ?

        // buscamos la tarea por su id
        $task = Task::find($taskId);
        // una vez encontrada la tarea, actualizamos
        $task->update($request->all());
        return response()->json(["message" => "Tarea actualizada correctamente"], 200);
    }

    // metodo para eliminar una tarea por su ID
    public function destroy($taskId){
        $task = Task::find($taskId);
        $task->delete();
        
        return response()->json(["message" => "Tarea eliminada correctamente"], 200);
    }
}
