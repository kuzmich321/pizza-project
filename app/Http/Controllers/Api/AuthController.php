<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Wrong email or password. Try again.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(compact('token'), Response::HTTP_OK);
    }

    public function register(RegisterFormRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return response()->json([
           'status' => true,
           'user' => $user
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        return auth()->logout();
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
        ], Response::HTTP_OK);
    }
}
