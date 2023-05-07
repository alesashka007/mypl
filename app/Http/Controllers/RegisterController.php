<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(RegisterStoreRequest $request)
    {
        $user = new User;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        Auth::login($user);
        session(['alert' => __('Вы успешно зарегистрировались!'), 'a_status' => 'success']);
        return redirect()->route('home');

    }
}
