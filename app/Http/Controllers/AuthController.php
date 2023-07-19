<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    function register()
    {
        return view('auth/register');
    }

    function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'image' => ['mimes:jpg,png','image','max:4096'],
            'password' => ['required', 'string', 'min:8']
        ];
        $inputs = $request->only(
            'name',
            'email',
            'password',
        );

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return to_route('auth.register')->withInput()->withErrors($validator);
        }
        $user = User::make([
            'name' => $request->name,
            'email' => $request->email,
            'remember_token' => $request->_token,
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return redirect()->route('auth.loginForm');
    }

    function save(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return to_route('auth.loginForm')->withInput()->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
//            dd($user);
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('categories.index');
            } else {
                return redirect()->route('/');
            }
        } else {
            return redirect()->route('auth.loginForm')->withErrors(['userNotFound' => 'This user does not found'])->withInput();
        }

    }

    function login()
    {
        return view('auth.login');
    }

    function profile(User $user)
    {
        return view('auth.profile', array('user' => $user));
    }

    function update(User $user, Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'image' => ['mimes:jpg,png', 'image', 'max:4096'],
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return to_route('auth.profile', ['user' => $user])->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destination = public_path('/uploads/users');
            $file_name = $request->name . "-" . \Str::random(5) . "." . $image->getClientOriginalExtension();
            $image->move($destination, $file_name);
            if (isset($user->image)) {
                File::delete(public_path("uploads/users/$user->image"));
                $user->image = $file_name;
            }
            $user->image = $file_name;
        }
        $user->save();
        return redirect()->route('/');
    }

    function logout()
    {
        Auth::logout();
        return redirect(route('auth.loginForm'));
    }

}
