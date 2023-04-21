<?php

namespace App\Http\Services;

use App\Constants\ErrorCodes;
use App\Http\Results\OperationResult;
use App\Models\Doctor;
use Symfony\Component\HttpFoundation\Response;

class DoctorService
{
    public static function list(array $request): OperationResult
    {
        $result = new OperationResult();

        if (isset($request['is_datatable']) && $request['is_datatable']) {
            $query = datatables()->eloquent(Doctor::query())->toArray();
        } else {
            $query = Doctor::query()
                ->orderBy('sort')
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

        $query = Doctor::query()
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
    public static function storeDoctorType(array $request): OperationResult
    {
        $result = new OperationResult();

        $insert = Doctor::create([
            'name' => $request['company_type_name'],
            'sort' => $request['sort'],
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
    public static function updateDoctorType(array $request): OperationResult
    {
        $result = new OperationResult();

        $update = Doctor::where('id', $request['id'])->update([
            'name' => $request['company_type_name'],
            'sort' => $request['sort'],
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
    public static function deleteDoctorType(array $request): OperationResult
    {
        $result = new OperationResult();

        $delete = Doctor::destroy($request['id']);

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
