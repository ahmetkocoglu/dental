<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $result = AuthService::login($request->validated());

        return $this->json($result);
    }
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = AuthService::register($request->validated());

        return $this->json($result);
    }
}
