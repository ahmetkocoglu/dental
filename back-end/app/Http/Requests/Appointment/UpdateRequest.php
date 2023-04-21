<?php

namespace App\Http\Requests\Appointment;

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
            'id' => ['required', 'integer', 'exists:company_activity_definitions,id'],
            'company_activity_name' => ['required', 'min:3', 'string'],
            'sort' => ['nullable', 'numeric', 'max_digits:4'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => 'Firma Tipi ID',
            'company_activity_name' => 'Firma Faaliyet Adı',
            'sort' => 'Sıra No',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->segment(5)]);
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
