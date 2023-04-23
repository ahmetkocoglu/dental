<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clinic\DeleteRequest;
use App\Http\Requests\Clinic\IndexRequest;
use App\Http\Requests\Clinic\ShowRequest;
use App\Http\Requests\Clinic\StoreRequest;
use App\Http\Requests\Clinic\UpdateRequest;
use App\Http\Services\ClinicService;
use Illuminate\Http\JsonResponse;

class ClinicController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        $result = ClinicService::list($request->validated());

        return $this->json($result);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        $result = ClinicService::show($request->validated());

        return $this->json($result);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $result = ClinicService::storeClinicType($request->validated());

        return $this->json($result);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $result = ClinicService::updateClinicType($request->validated());

        return $this->json($result);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $result = ClinicService::deleteClinicType($request->validated());

        return $this->json($result);
    }
}
