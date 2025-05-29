<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
     static function users()
    {

        $user = User::all();


        return response()->json(['user' => $user]);

    }
      public static function register(Request $request)
    { // REQUEST ES LO QUE SE ENVIA ATRAVEZ DEL ENDPOINT 

        $validate = $request->validate([ //REALIZA LA VALIDACIÓN DE LOS CAMPOS
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|string'
        ]);

        // if ($validate) {
        //     return response()->json($validate);
        // }

        $user = User::create(//CREACION DEL USUARIO
            [
                'name' =>  $request->name,
                'email' =>  $request->email,
                'password' => $request->password,
            ]
        );
        $token = $user->createToken('auth_token')->plainTextToken;// CREA EL TOKEN DE SEGURIDAD DE USO

        return response()->json(['message'=>'Usuario creado correctamente','usuario'=>$user,'token_app'=>$token],200);
    }

    
   public static function login(Request $request){//DECLARAR QUE SE TRABAJA CON REQUEST

    if (!Auth::attempt($request->only('email', 'password'))) {

        return response()->json(['message' => 'Unautorized', 'code' => 401]);
    }
    $user = User::where('email', $request->email)->firstOrFail(); //TRAE EL USUARIO DE  LA BD

    $token = $user->createToken('auth_token')->plainTextToken;// CREA TOKEN CADA VEZ QUE SE LOGUEA
    
    return response()->json(['message' => 'Hi' . $user->name, 'accessToken' => $token, 'user' => $user]);
    
   } 
     public function logout(Request $request)
    {
        //hapus semua tuken by user
        $request->user()->tokens()->delete();
        //response no content
        return response()->noContent();
    }   
}
