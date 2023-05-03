<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'confirmed'],
            'agreement' => ['required']
        ]);
        $user = new User;

        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);

        $user->save();
        Auth::login($user);
        session(['alert' => __('Вы успешно зарегистрировались!'), 'a_status' => 'success']);
        return redirect()->route('home');

    }
}
