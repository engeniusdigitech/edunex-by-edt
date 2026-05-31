<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\ReturnBookRequest;
use App\Models\Library\BookIssue;
use App\Models\Library\Book;
use App\Models\Library\Setting;
use App\Services\Library\IssueService;
use Illuminate\Http\Request;

class BookReturnController extends Controller
{
    protected IssueService $issueService;

    public function __construct(IssueService $issueService)
    {
        $this->issueService = $issueService;
    }

    public function index(Request $request)
    {
        $query = BookIssue::with(['book', 'member'])->active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        $issues = $query->latest('issue_date')->paginate(15);

        return view('library.returns.index', compact('issues'));
    }

    public function returnBook(BookIssue $issue)
    {
        $issue->load(['book', 'member', 'fines']);

        // Fine calculation preview
        $settings = Setting::where('institute_id', auth()->user()->institute_id)->first();
        $finePerDay = $settings->fine_per_day ?? 0;
        $overdueDays = 0;
        $estimatedFine = 0;

        if ($issue->due_date && now()->greaterThan($issue->due_date)) {
            $overdueDays = now()->diffInDays($issue->due_date);
            $estimatedFine = $overdueDays * $finePerDay;
        }

        return view('library.returns.return', compact('issue', 'overdueDays', 'estimatedFine', 'finePerDay'));
    }

    public function store(ReturnBookRequest $request, BookIssue $issue)
    {
        try {
            $this->issueService->returnBook($issue, $request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('library.returns.index')->with('success', 'Book returned successfully.');
    }

    public function scanReturn(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $issue = BookIssue::active()
            ->whereHas('book', function ($q) use ($request) {
                $q->where('isbn', $request->code)
                    ->orWhere('id', $request->code);
            })
            ->with(['book', 'member'])
            ->first();

        if (!$issue) {
            return response()->json(['found' => false, 'message' => 'No active issue found for this book.'], 404);
        }

        return response()->json([
            'found' => true,
            'issue' => $issue,
        ]);
    }
}
