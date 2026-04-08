<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    
    //metodo que devuelva todos los usuarios
    public function getUsers(){
        // Query Builder / ORM (metodos mapeados) (base de datos)

        // select * from users
        $users = User::all(); //ORM

        // select * from users
        // $user = User::select('*')->get(); //query builder

        return response()->json($users, 200);
    }
}
