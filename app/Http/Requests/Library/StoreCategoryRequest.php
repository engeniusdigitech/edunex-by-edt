<?php

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
                "unique:library_categories,name,NULL,id,institute_id," . session('institute_id')
            ],
            'description' => 'nullable',
            'status' => 'boolean',
        ];
    }
}
