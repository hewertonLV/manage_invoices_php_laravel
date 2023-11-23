<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all();
        $token = auth('api')->attempt($credenciais);
        if ($token) {
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['erro' => 'Usuario ou senha Invalido.'],403);
        }
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Sessão finalizada.']);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token'=>$token]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
