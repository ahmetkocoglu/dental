<?php

namespace App\Http\Requests\Clinic;

use App\Constants\ErrorCodes;
use App\Http\Results\OperationResult;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:clinics,id'],
            'name' => ['required', 'min:3', 'string'],
            'doctor_id' => ['required', 'numeric'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => 'Klinik ID',
            'name' => 'Klinik Adı',
            'doctor_id' => 'Doktor ID',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->segment(3)]);
    }


    protected function failedValidation(Validator $validator)
    {
        $result = new OperationResult();

        $result->setStatus(false);
        $result->setErrors($validator->errors()->toArray());
        $result->setMessage(__('errors.default.validation.message'));
        $result->setErrorCode(ErrorCodes::VALIDATION_ERROR);

        throw new HttpResponseException(response()->json($result->toArray(), Response::HTTP_UNPROCESSABLE_ENTITY, [], JSON_UNESCAPED_UNICODE));
    }
}
