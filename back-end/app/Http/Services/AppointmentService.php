<?php

namespace App\Http\Services;

use App\Constants\DateConstants;
use App\Constants\ErrorCodes;
use App\Helpers\DateHelper;
use App\Http\Results\OperationResult;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AppointmentService
{
    public static function list(array $request): OperationResult
    {
        $result = new OperationResult();

        if (isset($request['is_datatable']) && $request['is_datatable']) {
            $query = datatables()->eloquent(Appointment::query())->toArray();
        } else {
            $query = Appointment::query()
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

        $query = Appointment::query()
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
    public static function storeAppointmentType(array $request): OperationResult
    {
        $result = new OperationResult();

        $timezoneType = collect((DateHelper::now())->toDateTime())->get('timezone_type');

        $hour = intval(DateHelper::format(DateConstants::DATE_HOUR_FORMAT, $request['appointment_date'])) + $timezoneType;

        Log::info(DateHelper::format(DateConstants::DATE_TIME_HOUR_FORMAT, $request['appointment_date']));

        $query = Appointment::query()
            ->where('doctor_id', $request['doctor_id'])
            ->where('appointment_date', $request['appointment_date'])
            ->get()->toArray();

        if ($query) {
            $result->setMessage(__('errors.default.crud.store'));
            $result->setErrorCode(ErrorCodes::APPOINTMENT_ERROR);
            $result->setHttpStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $result;
        }

        if ($hour < 9 && $hour > 18) {
            $result->setMessage(__('errors.default.crud.store'));
            $result->setErrorCode(ErrorCodes::APPOINTMENT_ERROR_TIME);
            $result->setHttpStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $result;
        }

        $insert = Appointment::create([
            'doctor_id' => $request['doctor_id'],
            'clinic_id' => $request['clinic_id'],
            'appointment_date' => DateHelper::format(DateConstants::DATE_TIME_HOUR_FORMAT, $request['appointment_date']),
            'treatments' => $request['treatments'],
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
    public static function updateAppointmentType(array $request): OperationResult
    {
        $result = new OperationResult();

        $update = Appointment::where('id', $request['id'])->update([
            'treatments' => $request['treatments'],
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
    public static function deleteAppointmentType(array $request): OperationResult
    {
        $result = new OperationResult();

        $delete = Appointment::destroy($request['id']);

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
