<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';
        if ($request->erro == 1){
            $erro = 'Usuario ou senha não existe.';
        } elseif ($request->erro ==20){
            toastr()->error('Faça o login para acessar o sistema.','Operação Invalida.');

        }
        return view('pages.login',
            ['erro'=>$erro]);
    }

    public function autenticar(Request $request){
        $rules = [
          'userName' => 'email',
          'password' => 'required',
        ];

        $feedback = [
            'userName.email' => 'O campo e-mail é obrigatorio',
            'password' => 'O campo senha é obrigatorio'
        ];

        $request->validate($rules,$feedback);

        $email = $request->userName;
        $password = $request->password;
        $request->validate($rules,$feedback);
        $user = new User();
//
        $userAutenticate= $user->where('email',$email)->where('password',$password)->get()->first();
//        print_r($userAutenticate);
//
        if (isset($userAutenticate->name)){
            session_start();
            $_SESSION['name'] = $userAutenticate->name;
            $_SESSION['email'] = $userAutenticate->email;
            return redirect()->route('cards');
        } else {
            toastr()->error('Email ou senha invalido.','Invalido');
//            return redirect()->route('login')->with(['email'=>$email ?? '']);
            return redirect()->route('login',['erro'=>1]);
        }

    }

    public function logoff() {
        session_destroy();
        toastr()->warning('Usuario saiu do sistema.','Realizado');
        return redirect()->route('login');
    }
}
