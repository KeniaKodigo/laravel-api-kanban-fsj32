<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

#[OA\Tag(name: "tasks", description: "Operations about tasks")]
#[OA\Schema(
    schema: "Task",
    title: "Task",
    description: "Task model",
    properties: [
        new OA\Property(property: "id", type: "integer", readOnly: true, example: 1),
        new OA\Property(property: "title", type: "string", example: "Implement Task API"),
        new OA\Property(property: "description", type: "string", example: "Develop CRUD operations."),
        new OA\Property(property: "status", type: "string", enum: ["pendiente", "en proceso", "completado"]),
        new OA\Property(property: "priority", type: "string", enum: ["baja", "media", "alta"]),
        new OA\Property(property: "due_date", type: "string", format: "date", example: "2025-10-30"),
        new OA\Property(property: "user_id", type: "integer", example: 5),
    ]
)]
class TaskController extends Controller
{
    //controlador que va tener todas las acciones de las tareas


    public function imprimirMensaje(){
        echo "Estamos en el controlador de las tareas";
    }

    // metodo para obtener todas las tareas
    #[OA\Get(
        path: "/tasks",
        tags: ["tasks"],
        summary: "Get all tasks with user names",
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "data", type: "array",
                            items: new OA\Items(ref: "#/components/schemas/Task"))
                    ]
                )
            )
        ]
    )]
    public function index(){
        // select tasks.id, tasks.title, tasks.description, tasks.status, tasks.priority, tasks.due_date, tasks.user_id, users.name as user from tasks inner join users on tasks.user_id = users.id

        $array_tasks = Task::select('tasks.id', 'tasks.title', 'tasks.description', 'tasks.status', 'tasks.priority', 'tasks.due_date', 'tasks.user_id', 'users.name as user')
        ->join('users','tasks.user_id', '=', 'users.id')
        ->get();
        return response()->json($array_tasks, 200);
    }


    // metodo para crear una nueva tarea
    #[OA\Post(
        path: "/tasks",
        tags: ["tasks"],
        summary: "Este endpoint es para crear tareas",
        description: "Creates a new task. Title must be unique and max 50 characters.",
        requestBody: new OA\RequestBody(
            required: true,
            description: "Task data for creation",
            content: new OA\JsonContent(
                required: ["title", "description", "status", "priority", "user_id"],
                properties: [
                    new OA\Property(
                        property: "title",
                        type: "string",
                        maxLength: 50,
                        example: "Fix critical bug",
                        description: "Unique title, max 50 characters"
                    ),
                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "The production database is failing.",
                        description: "Required, detailed description of the task"
                    ),
                    new OA\Property(
                        property: "status",
                        type: "string",
                        enum: ["pendiente", "en proceso", "completado"],
                        example: "pendiente",
                        description: "Required"
                    ),
                    new OA\Property(
                        property: "priority",
                        type: "string",
                        enum: ["baja", "media", "alta"],
                        example: "alta",
                        description: "Required"
                    ),
                    new OA\Property(
                        property: "due_date",
                        type: "string",
                        format: "date",
                        example: "2026-12-31",
                        nullable: true,
                        description: "Optional. Must be today or a future date (YYYY-MM-DD)"
                    ),
                    new OA\Property(
                        property: "user_id",
                        type: "integer",
                        example: 1,
                        description: "Required. Must be an existing user ID"
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Task created successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Tarea creada correctamente"),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation error",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "The title has already been taken."),
                        new OA\Property(
                            property: "errors",
                            type: "object",
                            example: [
                                "title" => ["The title has already been taken."],
                                "user_id" => ["The selected user_id is invalid."]
                            ]
                        ),
                    ]
                )
            ),
        ]
    )]
    public function store(StoreTaskRequest $request){
        
        //insert into table(campos) values() -> create()
        Task::create($request->all());
        // 201 => representa cuando se registro algo de manera correcta
        return response()->json(["message" => "Tarea creada correctamente"], 201);
    }


    // metodo para obtener una tarea en especifico
    #[OA\Get(
        path: "/tasks/{taskId}",
        tags: ["tasks"],
        summary: "Get a specific task by ID",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "taskId", in: "path", required: true,
                schema: new OA\Schema(type: "integer", example: 1))
        ],
        responses: [
            new OA\Response(response: 200, description: "Successful",
                content: new OA\JsonContent(ref: "#/components/schemas/Task")),
            new OA\Response(response: 404, description: "Task not found")
        ]
    )]
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
    #[OA\Patch(
        path: "/tasks/{taskId}",
        tags: ["tasks"],
        summary: "Update an existing task",
        description: "Partially updates a task. Only title, description and due_date can be modified.",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "taskId",
                in: "path",
                required: true,
                description: "ID of the task to update",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: "Fields allowed to update (title, description, due_date)",
            content: new OA\JsonContent(
                required: ["title", "description"],
                properties: [
                    new OA\Property(
                        property: "title",
                        type: "string",
                        maxLength: 50,
                        example: "Fix critical bug (updated)",
                        description: "Required, max 50 characters"
                    ),
                    new OA\Property(
                        property: "description",
                        type: "string",
                        example: "Updated description of the task.",
                        description: "Required"
                    ),
                    new OA\Property(
                        property: "due_date",
                        type: "string",
                        format: "date",
                        example: "2026-12-31",
                        nullable: true,
                        description: "Optional. Must be today or a future date (YYYY-MM-DD)"
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Task updated successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Tarea actualizada correctamente"),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthorized - Token missing or invalid",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Unauthenticated."),
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation error",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "The title field is required."),
                        new OA\Property(
                            property: "errors",
                            type: "object",
                            example: [
                                "title" => ["The title field is required."],
                                "due_date" => ["The due date must be a date after or equal to today."]
                            ]
                        ),
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Task not found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "No se encontro la tarea"),
                    ]
                )
            ),
        ]
    )]
    public function update(UpdateTaskRequest $request, $taskId){
        // update tasks set title = 'dato 1', description = 'dato 2', due_date = '2026-02-25' where id = ?

        // buscamos la tarea por su id
        $task = Task::find($taskId);
        // una vez encontrada la tarea, actualizamos
        $task->update($request->all());
        return response()->json(["message" => "Tarea actualizada correctamente"], 200);
    }

    // metodo para eliminar una tarea por su ID
    #[OA\Delete(
        path: "/tasks/{taskId}",
        tags: ["tasks"],
        summary: "Delete a task",
        security: [["bearerAuth" => []]],
        parameters: [
            new OA\Parameter(name: "taskId", in: "path", required: true,
                schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Task deleted successfully"),
            new OA\Response(response: 404, description: "Task not found")
        ]
    )]
    public function destroy($taskId){
        $task = Task::find($taskId);
        $task->delete();
        
        return response()->json(["message" => "Tarea eliminada correctamente"], 200);
    }
}
