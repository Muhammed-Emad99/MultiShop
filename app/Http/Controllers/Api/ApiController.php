<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    function list()
    {
        $categories = Category::all();
        return response()->json(array('categories' => $categories));
    }
    function register(Request $request): JsonResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'image' => ['mimes:jpg,png', 'image', 'max:4096'],
            'password' => ['required', 'string', 'min:8']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json(['success' => false, 'message' => 'error', 'error' => ['errors'=>$errors]]);
        }
        $user = User::make([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => \Str::random(100),

        ]);
        $user->save();
        return response()->json(['success' => false, 'message' => 'success', 'data' => ['user' => $user]]);
    }

    function login(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->messages();
            return response()->json(['success' => false, 'message' => 'error', 'error' => ['errors'=>$errors]]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (!isset(Auth::user()->remember_token)) {
                return response()->json(['success' => false, 'message' => 'this email does not exist You need to register']);
            }
            return response()->json(['success' => false, 'message' => 'success', 'data' => ['user' => Auth::user()]]);
        } else {
            return response()->json(['success' => false, 'message' => 'this email does not exist You need to register']);
        }
    }

}
