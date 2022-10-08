<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Http\Requests\User\EditUserValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{

    /**
     * Форма авторизация
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * Получения данных с формы авторизации через POST запрос
     * @param LoginValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost(LoginValidation $request)
    {
        if(Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return back()->with(['success' => 'true']);
        }
        return back()->withErrors(['auth' => 'Логин или пароль не верный!']);
    }

    /**
     * Форма регистрации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register()
    {
        return view('users.register');
    }

    /**
     * Получения данных с формы регистрации через POST запрос
     * @param RegisterValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerPost(RegisterValidation $request)
    {
        $requests = $request->validated();
        $requests['password'] = Hash::make($requests['password']);
        User::create($requests);
        return redirect()->route('login')->with(['register' => true]);
    }

    /**
     * Вызов страницы с кабинетом
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cabinet()
    {
        return view('users.cabinet');
    }

    /**
     * Вызов страницы с редактированием аккаунта
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cabinetEdit()
    {
        return view('users.edit');
    }

    /**
     * Функция для редактирования аккаунта
     * @param EditUserValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cabinetEditPost(EditUserValidation $request)
    {
        $arr = $request->validated();
        if($arr['password']) unset($arr['password']);
        else $arr['password'] = Hash::make($arr['password']);
        $user = Auth::user();
        $user->update($arr);
        return back()->with(['success' => true]);
    }


    /**
     * Выход из аккаунта пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

    /**
     * Вызов страницы со всеми пользователями для админа
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function users()
    {
        $breadcrumbs = [
            ['routeName' => 'welcome', 'name' => 'Главная страница'],
            ['name'=> 'Пользователи']
        ];
        $users = User::all();

        # compact => [ 'users', => $users ]
        return view('admin.users.user', compact('users', 'breadcrumbs'));
    }

}
