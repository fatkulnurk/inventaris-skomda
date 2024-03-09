<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService = new AuthService())
    {
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'sometimes|string|max:255',
            'email' => 'required_if:username,null|email|max:255',
            'password' => 'required|string|min:6|max:255',
        ]);

        try {
            $user = $this->authService->login($validated);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], ($e->getCode() >= 400 && $e->getCode() < 500 ? $e->getCode() : 401));
        }

        return response([
            'message' => 'Success login',
            'data' => [
                'role' => $user->role,
                'token' => $this->authService->generateToken($user)
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response([
            'message' => 'Success logout'
        ]);
    }
}
