<?php

namespace App\Http\Services\Auth;

use App\Constants\ErrorCodes;
use App\Helpers\DateHelper;
use App\Helpers\GlobalHelper;
use App\Http\Results\OperationResult;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public static function login(array $request): OperationResult
    {
        $result = new OperationResult();

        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']], true)) {
            $result->setStatus(false);
            $result->setHttpStatusCode(Response::HTTP_BAD_REQUEST);
            $result->setMessage(GlobalHelper::errorMessage(ErrorCodes::LOGIN_ATTEMPT_ERROR));
            $result->setErrorCode(ErrorCodes::LOGIN_ATTEMPT_ERROR);

            return $result;
        }
        $user = User::signInUserByEmail($request['email']);

        $tokenPassiveDate = DateHelper::addDays();

        activity()
            ->event('users')
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties(['type' => 'activity'])
            ->log('Sisteme Giriş Yaptı');

        $result->setStatus(true);
        $result->setHttpStatusCode(Response::HTTP_OK);
        $result->setMessage(__('success.auth.login'));
        $result->setData([]);
        $result->setData([
            'token' => $user->createToken('api-token', ['*'], $tokenPassiveDate)->plainTextToken,
            'user' => $user->toArray(),
            'token_passive_date' => $tokenPassiveDate->toDateTime()
        ]);

        return $result;
    }
}
