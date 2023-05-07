<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = new User;
        return view('user.profile', ['user' => $user->find(request()->user()->id)]);
    }
    public function save(UserSaveRequest $request)
    {
        $id = request()->user()->id;
        $user = new User;
        if (!$user->find($id)) {
            session(['alert' => __('Пользователь не найден!'), 'a_status' => 'danger']);

            return redirect()->route('home');
        }
        $user->where(['id' => $id])->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ]);

        if($request->old_password){
            if(Hash::check($request->old_password, request()->user()->password)){
                $validated = $request->validate([
                    'password' => ['required', 'string', 'min:7', 'confirmed']
                ]);
                $user->where(['id' => $id])->update([
                    'password' => bcrypt($validated['password'])
                ]);
            }else{
                session(['alert' => __('Не верный старый пароль!'), 'a_status' => 'danger']);
                return redirect()->route('profile');
            }
        }
        session(['alert' => __('Пользователь успешно изменен!'), 'a_status' => 'success']);
        return redirect()->route('profile');
    }
    public function users (Request $request)
    {
        $users = new User;
        return view('admin.users.index', ['users' => $users->paginate(10)]);
    }
    public function edit(string $id)
    {
        $user = new User;
        if (!$user->find($id)) {
            session(['alert' => __('Пользователь не найден!'), 'a_status' => 'danger']);

            return redirect()->route('admin.users');
        }
//        dd($user->find($id));
        return view('admin.users.edit', ['user' => $user->find($id)]);
    }
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = new User;
        if (!$user->find($id)) {
            session(['alert' => __('Пользователь не найден!'), 'a_status' => 'danger']);

            return redirect()->route('admin.users');
        }
        $user->where(['id' => $id])->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'balance' => $request->balance,
            'admin' => $request->admin,
        ]);
        session(['alert' => __('Пользователь успешно изменен!'), 'a_status' => 'success']);

        return redirect()->route('admin.users');
    }
    public function destroy(string $id)
    {
        $user = new User;


        if(!$user->find($id)){
            session(['alert' => __('Пользователь не найден!'), 'a_status' => 'danger']);

            return redirect()->route('admin.users');
        }

        if($id == request()->user()->id){
            session(['alert' => __('Вы не можете удалить сами себя!'), 'a_status' => 'danger']);

            return redirect()->route('admin.users');
        }
        $objects = 0;
        $objects = $objects + modelCountEl("News", 'user', $id);
        if($objects > 0){
            session(['alert' => __('Вы не можете удалить пользователя так как есть созданые обьекты с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.users');
        }

        $user->find($id)->delete();

        session(['alert' => __('Пользователь успешно удален!'), 'a_status' => 'success']);

        return redirect()->route('admin.users');
    }
}
