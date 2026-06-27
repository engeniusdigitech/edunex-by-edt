<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\Library\Category;
use App\Models\Library\DigitalResource;
use App\Models\Library\Fine;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['category', 'author']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhereHas('author', fn($a) => $a->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->latest()->get();
        $categories = Category::orderBy('name')->get();

        return response()->json([
            'books' => $books->map(function ($book) {
                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'isbn' => $book->isbn,
                    'author_name' => $book->author ? $book->author->name : null,
                    'category_name' => $book->category ? $book->category->name : null,
                    'available_copies' => $book->available_copies,
                    'total_copies' => $book->total_copies,
                    'cover_image_url' => $book->cover_image_url,
                ];
            })->values(),
            'categories' => $categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            })->values(),
        ]);
    }

    public function myBooks(Request $request)
    {
        $student = $request->user();

        $issues = BookIssue::where('member_type', Student::class)
            ->where('member_id', $student->id)
            ->active()
            ->with(['book.category', 'book.author'])
            ->latest('issue_date')
            ->get();

        return response()->json([
            'issues' => $issues->map(function ($issue) {
                return [
                    'id' => $issue->id,
                    'book_id' => $issue->book_id,
                    'book_title' => $issue->book ? $issue->book->title : null,
                    'book_author' => ($issue->book && $issue->book->author) ? $issue->book->author->name : null,
                    'book_cover_url' => $issue->book ? $issue->book->cover_image_url : null,
                    'issue_date' => $issue->issue_date ? $issue->issue_date->format('Y-m-d') : null,
                    'due_date' => $issue->due_date ? $issue->due_date->format('Y-m-d') : null,
                    'is_overdue' => $issue->is_overdue,
                    'fine_amount' => $issue->calculated_fine,
                    'status' => $issue->status,
                ];
            })->values(),
        ]);
    }

    public function history(Request $request)
    {
        $student = $request->user();

        $issues = BookIssue::where('member_type', Student::class)
            ->where('member_id', $student->id)
            ->with(['book.category', 'book.author'])
            ->latest('issue_date')
            ->get();

        return response()->json([
            'issues' => $issues->map(function ($issue) {
                return [
                    'id' => $issue->id,
                    'book_id' => $issue->book_id,
                    'book_title' => $issue->book ? $issue->book->title : null,
                    'book_author' => ($issue->book && $issue->book->author) ? $issue->book->author->name : null,
                    'book_cover_url' => $issue->book ? $issue->book->cover_image_url : null,
                    'issue_date' => $issue->issue_date ? $issue->issue_date->format('Y-m-d') : null,
                    'due_date' => $issue->due_date ? $issue->due_date->format('Y-m-d') : null,
                    'return_date' => $issue->return_date ? $issue->return_date->format('Y-m-d') : null,
                    'is_overdue' => $issue->is_overdue,
                    'fine_amount' => $issue->calculated_fine,
                    'status' => $issue->status,
                ];
            })->values(),
        ]);
    }

    public function fines(Request $request)
    {
        $student = $request->user();

        $fines = Fine::whereHas('bookIssue', function ($q) use ($student) {
            $q->where('member_type', Student::class)
                ->where('member_id', $student->id);
        })
            ->with(['bookIssue.book'])
            ->latest()
            ->get();

        $total = $fines->sum('fine_amount');
        $paid = $fines->where('payment_status', 'paid')->sum('fine_amount');
        $pending = $fines->where('payment_status', 'unpaid')->sum('fine_amount');

        return response()->json([
            'summary' => [
                'total' => (float) $total,
                'paid' => (float) $paid,
                'pending' => (float) $pending,
            ],
            'fines' => $fines->map(function ($fine) {
                return [
                    'id' => $fine->id,
                    'book_title' => ($fine->bookIssue && $fine->bookIssue->book) ? $fine->bookIssue->book->title : null,
                    'amount' => (float) $fine->fine_amount,
                    'reason' => $fine->fine_reason,
                    'status' => $fine->payment_status,
                    'paid_at' => $fine->payment_date ? $fine->payment_date->format('Y-m-d') : null,
                ];
            })->values(),
        ]);
    }

    public function digital(Request $request)
    {
        $query = DigitalResource::where(function ($q) {
            $q->whereNull('access_roles')
                ->orWhere('access_roles', 'like', '%student%')
                ->orWhere('access_roles', 'like', '%all%');
        });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $resources = $query->latest()->get();

        return response()->json([
            'resources' => $resources->map(function ($resource) {
                return [
                    'id' => $resource->id,
                    'title' => $resource->title,
                    'description' => $resource->description,
                    'file_type' => $resource->file_type,
                    'file_size_formatted' => $resource->formatted_file_size,
                    'is_downloadable' => $resource->is_downloadable,
                    'preview_url' => $resource->file_path ? Storage::url($resource->file_path) : null,
                    'download_url' => ($resource->is_downloadable && $resource->file_path)
                        ? Storage::url($resource->file_path)
                        : null,
                ];
            })->values(),
        ]);
    }
}
