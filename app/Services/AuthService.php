<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $users
    ) { }

    public function register(string $name, string $email, string $password): ?User
    {
        return $this->users->create([
            'name'=> $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function login(string $email, string $password, string $device): string
    {
        $user = $this->users->findByEmail($email);

        if (! ($user && Hash::check($password, $user->password))) {
            throw ValidationException::withMessages([
                'message' => 'The provided credentials are incorrect',
            ]);
        }

        return $user->createToken($device)->plainTextToken;
    }
}
