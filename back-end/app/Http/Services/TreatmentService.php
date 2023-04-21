<?php

namespace App\Http\Services;

use App\Constants\ErrorCodes;
use App\Http\Results\OperationResult;
use App\Models\Treatment;
use Symfony\Component\HttpFoundation\Response;

class TreatmentService
{
    public static function list(array $request): OperationResult
    {
        $result = new OperationResult();

        if (isset($request['is_datatable']) && $request['is_datatable']) {
            $query = datatables()->eloquent(Treatment::query())->toArray();
        } else {
            $query = Treatment::query()
                ->orderBy('id', 'desc')
                ->get()->toArray();
        }

        if (!$query) {
            $result->setMessage(__('errors.default.crud.list'));
            $result->setErrorCode(ErrorCodes::LIST_ERROR);
            $result->setHttpStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $result;
        }

        $result->setStatus(true);
        $result->setHttpStatusCode(Response::HTTP_OK);
        $result->setData($query);
        $result->setMessage(__('success.default.crud.list'));

        return $result;
    }

    public static function show(array $request): OperationResult
    {
        $result = new OperationResult();

        $query = Treatment::query()
            ->where('id', $request['id'])
            ->get()->toArray();

        if (!$query) {
            $result->setMessage(__('errors.default.crud.show'));
            $result->setErrorCode(ErrorCodes::SHOW_ERROR);
            $result->setHttpStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $result;
        }

        $result->setStatus(true);
        $result->setHttpStatusCode(Response::HTTP_OK);
        $result->setData($query);
        $result->setMessage(__('success.default.crud.show'));

        return $result;
    }
    public static function storeTreatmentType(array $request): OperationResult
    {
        $result = new OperationResult();

        $insert = Treatment::create([
            'name' => $request['name'],
        ]);

        if (!$insert) {
            $result->setMessage(__('errors.default.crud.store'));
            $result->setErrorCode(ErrorCodes::STORE_ERROR);
            $result->setHttpStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $result;
        }

        $result->setStatus(true);
        $result->setHttpStatusCode(Response::HTTP_OK);
        $result->setData($insert->toArray());
        $result->setMessage(__('success.default.crud.store'));

        return $result;
    }
    public static function updateTreatmentType(array $request): OperationResult
    {
        $result = new OperationResult();

        $update = Treatment::where('id', $request['id'])->update([
            'name' => $request['name'],
        ]);

        if (!$update) {
            $result->setMessage(__('errors.default.crud.update'));
            $result->setErrorCode(ErrorCodes::UPDATE_ERROR);
            $result->setHttpStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $result;
        }

        $result->setStatus(true);
        $result->setHttpStatusCode(Response::HTTP_OK);
        $result->setData($request);
        $result->setMessage(__('success.default.crud.update'));

        return $result;
    }
    public static function deleteTreatmentType(array $request): OperationResult
    {
        $result = new OperationResult();

        $delete = Treatment::destroy($request['id']);

        if (!$delete) {
            $result->setMessage(__('errors.default.crud.delete'));
            $result->setErrorCode(ErrorCodes::DELETE_ERROR);
            $result->setHttpStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $result;
        }

        $result->setStatus(true);
        $result->setHttpStatusCode(Response::HTTP_OK);
        $result->setMessage(__('success.default.crud.delete'));

        return $result;
    }
}
