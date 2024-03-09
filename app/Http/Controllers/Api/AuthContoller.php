<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthContoller extends Controller
{

    public function __construct(private AuthService $authService = new AuthService())
    {
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
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
}
