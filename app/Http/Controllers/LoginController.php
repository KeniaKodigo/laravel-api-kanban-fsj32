<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Tag(name: "auth", description: "Operations about authentication")]
class LoginController extends Controller
{
    //
    #[OA\Post(
        path: "/login",
        tags: ["auth"],
        summary: "Login user",
        description: "Authenticates a user and returns a Bearer token.",
        requestBody: new OA\RequestBody(
            required: true,
            description: "User credentials",
            content: new OA\JsonContent(
                required: ["email", "password"],
                properties: [
                    new OA\Property(
                        property: "email",
                        type: "string",
                        format: "email",
                        example: "juan@example.com"
                    ),
                    new OA\Property(
                        property: "password",
                        type: "string",
                        format: "password",
                        example: "123456"
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Login successful",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "username", type: "string", example: "Juan Pérez"),
                        new OA\Property(property: "email", type: "string", example: "juan@example.com"),
                        new OA\Property(property: "access_token", type: "string", example: "1|abc123xyz..."),
                        new OA\Property(property: "token_type", type: "string", example: "Bearer"),
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Invalid credentials",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Credenciales Incorrectas"),
                    ]
                )
            ),
        ]
    )]
    public function login(Request $request){
        $email = $request->input('email');
        $password =  $request->input('password');

        //validar si el correo y la contraseña existen en la base de datos
        // select * from users where email = ? and password = ?
        $user = User::where('email', $email)->where('password', $password)->first();
        if($user){
            //crear el token del usuario
            $token = $user->createToken('token_fsj32')->plainTextToken;
            return response()->json([
                'username' => $user->name,
                'email' => $user->email,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 200);
        }else{
            return response()->json(["message" => "Credenciales Incorrectas"], 401);
        }
    }

    #[OA\Post(
        path: "/logout",
        tags: ["auth"],
        summary: "Logout user",
        description: "Revokes all tokens of the authenticated user.",
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Logout successful",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Has cerrado sesion"),
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
        ]
    )]
    public function logout(Request $request){
        //cuando el usuario cierre sesion eliminamos los tokens de el
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Has cerrado sesion"], 200);
    }
}
