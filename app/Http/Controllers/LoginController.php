<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        $user = User::where(['email' => $request->email])->first();
        if($user){
            if(Hash::check($request->password, $user['password'])){
                Auth::login($user);
                session(['alert' => __('Вы успешно авторизовались!'), 'a_status' => 'success']);
                return redirect()->route('home');
            }else{
                session(['alert'=>__('Не верный пароль!'),'a_status'=>'danger']);
                return redirect()->route('login')->withInput();
            }
        }else{
            session(['alert'=>__('Пользователь с таким email не найден!'),'a_status'=>'danger']);
            return redirect()->route('login');
        }
    }
}
