<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\DeleteRequest;
use App\Http\Requests\Appointment\IndexRequest;
use App\Http\Requests\Appointment\ShowRequest;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Http\Services\TreatmentService;
use Illuminate\Http\JsonResponse;

class TreatmentController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        $result = TreatmentService::list($request->validated());

        return $this->json($result);
    }

    public function show(ShowRequest $request): JsonResponse
    {
        $result = TreatmentService::show($request->validated());

        return $this->json($result);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $result = TreatmentService::storeTreatmentType($request->validated());

        return $this->json($result);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $result = TreatmentService::updateTreatmentType($request->validated());

        return $this->json($result);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $result = TreatmentService::deleteTreatmentType($request->validated());

        return $this->json($result);
    }
}
