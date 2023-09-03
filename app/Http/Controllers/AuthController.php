<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api'], ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['status' => 'error', 'message' => 'იუზერი ან პაროლი არასწორია'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function me()
    {
        return response()->json(Auth::user());
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => 'success', 'message' => 'წარმატებით გამოხვედით']);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response(['status' => 'success', 'message' => 'წარმატებით დარეგისტრილდით.']);
    }
}
