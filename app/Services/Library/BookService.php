<?php

namespace App\Services\Library;

use App\Models\Library\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookService
{
    /**
     * List books with filters, eager loading, and pagination.
     */
    public function list(Request $request)
    {
        $query = Book::with(['category', 'author', 'publisher']);

        if ($search = $request->input('search')) {
            $query->search($search);
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($authorId = $request->input('author_id')) {
            $query->where('author_id', $authorId);
        }

        if ($request->has('status') && $request->input('status') !== '') {
            $query->where('status', $request->boolean('status'));
        }

        return $query->latest()->paginate(15)->withQueryString();
    }

    /**
     * Create a new book, handle cover upload, generate barcode, and log audit.
     */
    public function create(array $data): Book
    {
        // Handle cover image upload
        if (isset($data['cover_image']) && $data['cover_image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['cover_image'] = $data['cover_image']->store('library/covers', 'public');
        }

        // Set available_copies equal to total_copies on creation
        $data['available_copies'] = $data['total_copies'];

        $book = Book::create($data);

        // Generate barcode
        $book->update([
            'barcode' => $this->generateBarcode($book),
        ]);

        AuditService::log('book_created', $book, null, $book->toArray());

        return $book;
    }

    /**
     * Update a book, handle cover replacement, and log audit.
     */
    public function update(Book $book, array $data): Book
    {
        $oldValues = $book->toArray();

        // Handle cover image replacement
        if (isset($data['cover_image']) && $data['cover_image'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old cover image
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $data['cover_image']->store('library/covers', 'public');
        }

        $book->update($data);

        AuditService::log('book_updated', $book, $oldValues, $book->fresh()->toArray());

        return $book;
    }

    /**
     * Soft delete a book if it has no active issues.
     *
     * @throws \Exception
     */
    public function delete(Book $book): void
    {
        // Check for active (issued) book issues
        if ($book->bookIssues()->where('status', 'issued')->exists()) {
            throw new \Exception('Cannot delete book with active issues. Please return all copies first.');
        }

        AuditService::log('book_deleted', $book, $book->toArray());

        $book->delete();
    }

    /**
     * Bulk delete books by IDs.
     *
     * @return array{deleted: int, failed: array}
     */
    public function bulkDelete(array $ids): array
    {
        $deleted = 0;
        $failed = [];

        foreach ($ids as $id) {
            $book = Book::find($id);
            if (!$book) {
                continue;
            }

            try {
                $this->delete($book);
                $deleted++;
            } catch (\Exception $e) {
                $failed[] = [
                    'id'    => $id,
                    'title' => $book->title,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return ['deleted' => $deleted, 'failed' => $failed];
    }

    /**
     * Generate a library barcode for a book.
     */
    public function generateBarcode(Book $book): string
    {
        return 'LIB-' . str_pad($book->id, 6, '0', STR_PAD_LEFT);
    }
}
