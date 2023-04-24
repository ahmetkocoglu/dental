<?php

namespace App\Http\Requests\Treatment;

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
            'id' => ['required', 'integer', 'exists:treatments,id'],
            'name' => ['required', 'min:3', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => 'Tedavi ID',
            'name' => 'Tedavi Adı',
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
