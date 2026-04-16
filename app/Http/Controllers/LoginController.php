<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

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


    public function logout(Request $request){
        //cuando el usuario cierre sesion eliminamos los tokens de el
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Has cerrado sesion"], 200);
    }
}
