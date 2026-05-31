<?php

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => 'required|exists:library_books,id',
            'member_id' => 'required|integer',
            'member_type' => 'required|in:student,staff',
        ];
    }
}
