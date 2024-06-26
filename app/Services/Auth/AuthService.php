<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $credentials)
    {
        $user = User::query()
            ->when(filled($credentials['username']), function ($query) use ($credentials) {
                return $query->where('username', $credentials['username']);
            })
            ->when(filled($credentials['email']), function ($query) use ($credentials) {
                return $query->where('email', $credentials['email']);
            })
            ->first();

        if (blank($user)) {
            throw new \Exception('Invalid credentials', 401);
        }

        if (Hash::check($credentials['password'], $user->password)) {
            throw new \Exception('Invalid credentials', 401);
        }

        return $user;
    }

    public function generateToken($user)
    {
        return $user->createToken('token')->plainTextToken;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }
}
