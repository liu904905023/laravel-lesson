<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequset;
use App\Mail\RegisterShipped;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function register() {

        return view('users.register');

    }

    public function store(UserRegisterRequset $request) {
//        dd($request->all());
        $data = [
            'confirm_code' => str_random(48),
            'avatar'=>'/image/defult.png'
        ];
        $user = User::create(array_merge($request->all(),$data));
        return redirect('/');


    }

    public function login() {
        return view('users.login');
    }

    public function signin(UserLoginRequest $request) {
        if (Auth::attempt([
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
        ])) {
            return redirect('/');
        }
        \Session::flash('user_login_failed','错了');

        return redirect('user/login')->withInput();
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }







}
