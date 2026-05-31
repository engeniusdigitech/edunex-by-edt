<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\Library\Category;
use App\Models\Library\Author;
use App\Models\Library\DigitalResource;
use App\Models\Library\Fine;
use App\Models\Student;
use App\Services\Library\ReservationService;
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

        if ($request->filled('author_id')) {
            $query->where('author_id', $request->author_id);
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        $books = $query->latest()->paginate(15);
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('student.library.index', compact('books', 'categories', 'authors'));
    }

    public function myBooks()
    {
        /** @var \App\Models\Student $student */
        $student = auth()->guard('student')->user();

        $issues = BookIssue::where('member_type', Student::class)
            ->where('member_id', $student->id)
            ->active()
            ->with(['book.category', 'book.author'])
            ->latest('issue_date')
            ->get();

        return view('student.library.my-books', compact('issues'));
    }

    public function history()
    {
        /** @var \App\Models\Student $student */
        $student = auth()->guard('student')->user();

        $issues = BookIssue::where('member_type', Student::class)
            ->where('member_id', $student->id)
            ->with(['book.category', 'book.author'])
            ->latest('issue_date')
            ->paginate(15);

        return view('student.library.history', compact('issues'));
    }

    public function fines()
    {
        /** @var \App\Models\Student $student */
        $student = auth()->guard('student')->user();

        $fines = Fine::whereHas('bookIssue', function ($q) use ($student) {
            $q->where('member_type', Student::class)
                ->where('member_id', $student->id);
        })
            ->with(['bookIssue.book'])
            ->latest()
            ->paginate(15);

        $totalFines = (clone $fines->getCollection())->sum('fine_amount');
        $paidFines = (clone $fines->getCollection())->where('payment_status', 'paid')->sum('fine_amount');
        $pendingFines = (clone $fines->getCollection())->where('payment_status', 'unpaid')->sum('fine_amount');

        return view('student.library.fines', compact('fines', 'totalFines', 'paidFines', 'pendingFines'));
    }

    public function reserve(Book $book, ReservationService $reservationService)
    {
        /** @var \App\Models\Student $student */
        $student = auth()->guard('student')->user();

        try {
            $reservationService->reserve([
                'member_id' => $student->id,
                'member_type' => Student::class,
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

        $resources = $query->latest()->paginate(15);

        return view('student.library.digital', compact('resources'));
    }

    public function downloadResource(DigitalResource $digitalResource)
    {
        // Verify access
        $accessRoles = $digitalResource->access_roles;
        if ($accessRoles && !in_array('student', (array) $accessRoles) && !in_array('all', (array) $accessRoles)) {
            abort(403, 'You do not have access to this resource.');
        }

        if (!$digitalResource->file_path || !Storage::disk('public')->exists($digitalResource->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $digitalResource->increment('download_count');

        return Storage::disk('public')->download(
            $digitalResource->file_path,
            $digitalResource->title . '.' . $digitalResource->file_type
        );
    }

    public function previewResource(DigitalResource $digitalResource)
    {
        // Verify access
        $accessRoles = $digitalResource->access_roles;
        if ($accessRoles && !in_array('student', (array) $accessRoles) && !in_array('all', (array) $accessRoles)) {
            abort(403, 'You do not have access to this resource.');
        }

        if (!$digitalResource->file_path || !Storage::disk('public')->exists($digitalResource->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $filePath = Storage::disk('public')->path($digitalResource->file_path);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $digitalResource->title . '.pdf"',
        ]);
    }
}
