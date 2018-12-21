<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequset;
use App\User;
use GuzzleHttp\Psr7\Response;
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
        User::register(array_merge($request->all(),$data));
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


    public function avatar() {

        return view('users/avatar');

    }

    public function changeAvatar(Request $request) {
        $file = $request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) {
            return \Response::json([
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray()
            ]);
        }
        $dir = 'uploads/';
        $filename = Auth::user()->id . time() . $file->getClientOriginalName();

        $base=($request->file('avatar'));
        \Image::make($base)->fit(400)->save($dir.$filename);
//
//
//        $file->move($dir, $filename);
//        \Image::make($dir.$filename)->fit(200)->save();

        $user = User::find(Auth::user()->id);
        $user->avatar = "/".$dir . $filename;
        $user->save();
        return \Response::json([
            'success'=>true,
            'avatar'=>asset($dir.$filename),
        ]);
//        return redirect('user/avatar'); FORM提交


    }

    public function cropAvatar(Request $request) {
        $photo = $request->get('photo');
        $width = $request->get('w');
        $height = $request->get('h');
        $xAlign = $request->get('x');
        $yAlign = $request->get('y');
        \Image::make('uploads/'.basename($photo))->crop($width,$height,$xAlign,$yAlign)->save();
        $user = User::find(Auth::user()->id);
        $user->avatar = $photo;
        $user->save();
        return redirect('/user/avatar');

    }
}
