<?php

namespace App\Http\Controllers;

use App\Http\Results\OperationResult;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function json(OperationResult $result): JsonResponse
    {
        return response()->json($result->toArray(), $result->getHttpStatusCode(), [], JSON_UNESCAPED_UNICODE);
    }
}
