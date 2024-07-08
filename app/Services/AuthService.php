<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(string $name, string $email, string $password): ?User
    {
        return User::create([
            'name'=> $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function login(string $email, string $password, string $device): string
    {
        $user = User::where('email', $email)->first();

        if (! ($user && Hash::check($password, $user->password))) {
            throw ValidationException::withMessages([
                'message' => 'The provided credentials are incorrect',
            ]);
        }

        return $user->createToken($device)->plainTextToken;
    }
}
