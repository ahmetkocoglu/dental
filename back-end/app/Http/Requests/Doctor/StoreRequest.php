<?php

namespace App\Http\Requests\Doctor;

use App\Constants\ErrorCodes;
use App\Http\Results\OperationResult;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'string'],
            'phone' => ['required', 'min:3', 'string'],
            'photo_path' => ['required', 'min:3', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Doktor Adı',
            'phone' => 'Telefon No',
            'photo_path' => 'Resim Yolu',
        ];
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
