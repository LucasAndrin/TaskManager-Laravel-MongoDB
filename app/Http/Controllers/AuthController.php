<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $service
    ) { }

    public function register(RegisterRequest $request): JsonResponse
    {
        $this->service->register(
            $request->name,
            $request->email,
            $request->password
        );

        return response()->json([
            'message' => 'Registration completed successfully'
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $token = $this->service->login(
            $request->email,
            $request->password,
            $request->device
        );

        return response()->json([
            'token' => $token
        ]);
    }
}
