<?php

namespace App\Http\Services;

use App\Constants\ErrorCodes;
use App\Http\Results\OperationResult;
use App\Models\Clinic;
use Symfony\Component\HttpFoundation\Response;

class ClinicService
{
    public static function list(array $request): OperationResult
    {
        $result = new OperationResult();

        if (isset($request['is_datatable']) && $request['is_datatable']) {
            $query = datatables()->eloquent(Clinic::query())->toArray();
        } else {
            $query = Clinic::query()
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

        $query = Clinic::query()
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
    public static function storeClinicType(array $request): OperationResult
    {
        $result = new OperationResult();

        $insert = Clinic::create([
            'name' => $request['name'],
            'doctor_id' => $request['doctor_id'],
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
    public static function updateClinicType(array $request): OperationResult
    {
        $result = new OperationResult();

        $update = Clinic::where('id', $request['id'])->update([
            'name' => $request['name'],
            'doctor_id' => $request['doctor_id'],
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
    public static function deleteClinicType(array $request): OperationResult
    {
        $result = new OperationResult();

        $delete = Clinic::destroy($request['id']);

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
