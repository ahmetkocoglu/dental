<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_datatable' => ['sometimes', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'is_datatable' => 'Datatable',
        ];
    }
}
