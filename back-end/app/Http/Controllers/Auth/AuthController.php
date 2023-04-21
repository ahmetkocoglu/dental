<?php

namespace App\Http\Controllers\Auth;

use App\Constants\ErrorCodes;
use App\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Results\OperationResult;
use App\Http\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function test(): JsonResponse
    {
        $result = new OperationResult();
        $result->setStatus(false);
        $result->setHttpStatusCode(Response::HTTP_BAD_REQUEST);
        $result->setMessage(GlobalHelper::errorMessage(ErrorCodes::LOGIN_ATTEMPT_ERROR));
        $result->setErrorCode(ErrorCodes::LOGIN_ATTEMPT_ERROR);
        return $this->json($result);
    }
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
