<?php

namespace App\Http\Controllers;

use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\Library\Category;
use App\Models\Library\Author;
use App\Models\Library\DigitalResource;
use App\Models\User;
use App\Services\Library\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherLibraryController extends Controller
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

        if ($request->filled('author_id')) {
            $query->where('author_id', $request->author_id);
        }

        $books = $query->latest()->paginate(15);
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('teacher.library.index', compact('books', 'categories', 'authors'));
    }

    public function myBooks()
    {
        $issues = BookIssue::where('member_type', User::class)
            ->where('member_id', auth()->id())
            ->active()
            ->with(['book.category', 'book.author'])
            ->latest('issue_date')
            ->get();

        return view('teacher.library.my-books', compact('issues'));
    }

    public function history()
    {
        $issues = BookIssue::where('member_type', User::class)
            ->where('member_id', auth()->id())
            ->with(['book.category', 'book.author'])
            ->latest('issue_date')
            ->paginate(15);

        return view('teacher.library.history', compact('issues'));
    }

    public function reserve(Book $book, ReservationService $reservationService)
    {
        try {
            $reservationService->reserve([
                'member_id' => auth()->id(),
                'member_type' => User::class,
                'book_id' => $book->id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Book reserved successfully.');
    }

    public function digitalLibrary(Request $request)
    {
        $query = DigitalResource::with('book');

        $query->where(function ($q) {
            $q->whereNull('access_roles')
                ->orWhere('access_roles', 'like', '%teacher%')
                ->orWhere('access_roles', 'like', '%all%');
        });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $resources = $query->latest()->paginate(15);

        return view('teacher.library.digital', compact('resources'));
    }
}
