<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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

        if (User::where('email', $input['email'])->where('role', User::ID_TYPE_GUEST)->exists()) {
            return $this->updateIfRegisteredAsGuest($input);
        }

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

    public function getOrCreateGuest(Request $request)
    {
        $input = $request->validate([
           'email' => 'required|email'
        ]);

        $guest = User::firstOrCreate(['email' => $input['email'], 'role' => User::ID_TYPE_GUEST], [
            'email' => $input['email'],
            'password' => bcrypt(Str::random(6)),
            'role' => USER::ID_TYPE_GUEST
        ]);

        return response()->json([
            'id' => $guest->id,
            'email' => $guest->email
        ], Response::HTTP_OK);
    }

    private function updateIfRegisteredAsGuest(array $validatedData)
    {
        User::where('email', $validatedData['email'])
            ->where('role', User::ID_TYPE_GUEST)
            ->update([
                'password' => $validatedData['password'],
                'role' => User::ID_TYPE_USER
            ]);

        $user = User::where('email', $validatedData['email'])->first();

        return response()->json([
            'message' => 'Guest was registered as user',
            'id' => $user->id,
            'email' => $user->email,
        ], Response::HTTP_OK);
    }
}
