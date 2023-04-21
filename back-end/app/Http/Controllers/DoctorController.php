<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\DeleteRequest;
use App\Http\Requests\Appointment\IndexRequest;
use App\Http\Requests\Appointment\ShowRequest;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Http\Services\DoctorService;
use Illuminate\Http\JsonResponse;

class DoctorController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        $result = DoctorService::list($request->validated());

        return $this->json($result);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        $result = DoctorService::show($request->validated());

        return $this->json($result);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $result = DoctorService::storeDoctorType($request->validated());

        return $this->json($result);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $result = DoctorService::updateDoctorType($request->validated());

        return $this->json($result);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $result = DoctorService::deleteDoctorType($request->validated());

        return $this->json($result);
    }
}
