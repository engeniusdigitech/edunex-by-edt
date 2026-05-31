<?php

namespace App\Http\Requests\Library;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'isbn' => [
                'nullable',
                'max:50',
                Rule::unique('library_books', 'isbn')
                    ->ignore($this->book)
                    ->where('institute_id', session('institute_id'))
            ],
            'category_id' => 'nullable|exists:library_categories,id',
            'author_id' => 'nullable|exists:library_authors,id',
            'publisher_id' => 'nullable|exists:library_publishers,id',
            'edition' => 'nullable|max:100',
            'language' => 'nullable|max:100',
            'rack_number' => 'nullable|max:50',
            'description' => 'nullable',
            'total_copies' => 'required|integer|min:1',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'boolean',
        ];
    }
}
