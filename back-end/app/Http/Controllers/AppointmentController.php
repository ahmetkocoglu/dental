<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\DeleteRequest;
use App\Http\Requests\Appointment\IndexRequest;
use App\Http\Requests\Appointment\ShowRequest;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Http\Services\AppointmentService;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        $result = AppointmentService::list($request->validated());

        return $this->json($result);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        $result = AppointmentService::show($request->validated());

        return $this->json($result);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $result = AppointmentService::storeAppointmentType($request->validated());

        return $this->json($result);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $result = AppointmentService::updateAppointmentType($request->validated());

        return $this->json($result);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $result = AppointmentService::deleteAppointmentType($request->validated());

        return $this->json($result);
    }
}
