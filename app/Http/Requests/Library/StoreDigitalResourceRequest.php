<?php

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;

class StoreDigitalResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,epub|max:51200',
            'book_id' => 'nullable|exists:library_books,id',
            'is_downloadable' => 'boolean',
            'access_roles' => 'nullable|array',
            'access_roles.*' => 'in:student,teacher,librarian,admin',
        ];
    }
}
