<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\StoreBookIssueRequest;
use App\Models\Batch;
use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\User;
use App\Services\Library\IssueService;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    protected IssueService $issueService;

    public function __construct(IssueService $issueService)
    {
        $this->issueService = $issueService;
    }

    public function index(Request $request)
    {
        $query = BookIssue::with(['book', 'member']);

        if ($request->filled('status')) {
            match ($request->status) {
                'active' => $query->active(),
                'returned' => $query->whereNotNull('return_date'),
                'overdue' => $query->overdue(),
                default => null,
            };
        }

        if ($request->filled('member_type')) {
            $query->where('member_type', $request->member_type === 'student'
                ? \App\Models\Student::class
                : User::class
            );
        }

        if ($request->filled('from_date')) {
            $query->whereDate('issue_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('issue_date', '<=', $request->to_date);
        }

        $issues = $query->latest()->paginate(15);

        return view('library.issues.index', compact('issues'));
    }

    public function create()
    {
        $batches = Batch::where('is_active', true)->with('students')->orderBy('name')->get();

        $staffMembers = User::whereHas('role', function ($q) {
            $q->whereIn('name', ['Teacher', 'Receptionist', 'Principal', 'Librarian']);
        })->orderBy('name')->get();

        $books = Book::where('available_copies', '>', 0)->orderBy('title')->get();

        $settings = \App\Models\Library\Setting::forInstitute();

        return view('library.issues.create', compact('batches', 'staffMembers', 'books', 'settings'));
    }

    public function store(StoreBookIssueRequest $request)
    {
        try {
            $this->issueService->issueBook($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('library.issues.index')->with('success', 'Book issued successfully.');
    }

    public function show(BookIssue $issue)
    {
        $issue->load(['book', 'member', 'fines']);

        return view('library.issues.show', compact('issue'));
    }

    public function scanIssue(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $book = Book::where('isbn', $request->code)
            ->orWhere('id', $request->code)
            ->with(['category', 'author'])
            ->first();

        if (!$book) {
            return response()->json(['found' => false, 'message' => 'Book not found.'], 404);
        }

        return response()->json([
            'found' => true,
            'book' => $book,
            'available' => $book->available_copies > 0,
        ]);
    }
}
