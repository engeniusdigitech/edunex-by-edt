<?php

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'max_books_student' => 'required|integer|min:1|max:50',
            'max_books_staff' => 'required|integer|min:1|max:50',
            'max_borrow_days' => 'required|integer|min:1|max:365',
            'fine_per_day' => 'required|numeric|min:0|max:1000',
            'reservation_expiry_days' => 'required|integer|min:1|max:30',
            'library_working_days' => 'nullable|array',
            'library_working_days.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
        ];
    }
}
