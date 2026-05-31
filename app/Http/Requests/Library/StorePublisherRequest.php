<?php

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;

class StorePublisherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|max:50',
            'address' => 'nullable',
            'status' => 'boolean',
        ];
    }
}
