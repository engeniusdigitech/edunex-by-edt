<?php

namespace App\Exports\Library;

use App\Models\Library\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Book::with(['category', 'author', 'publisher'])->get()->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'isbn' => $book->isbn,
                'author' => $book->author->name ?? '',
                'category' => $book->category->name ?? '',
                'publisher' => $book->publisher->name ?? '',
                'language' => $book->language ?? '',
                'edition' => $book->edition ?? '',
                'total_copies' => $book->total_copies,
                'available_copies' => $book->available_copies,
                'price' => $book->price,
                'shelf_location' => $book->shelf_location ?? '',
                'published_year' => $book->published_year ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'ISBN',
            'Author',
            'Category',
            'Publisher',
            'Language',
            'Edition',
            'Total Copies',
            'Available Copies',
            'Price',
            'Shelf Location',
            'Published Year',
        ];
    }
}
