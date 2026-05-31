<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Library\BookIssue;
use App\Models\Library\Fine;
use App\Services\Library\FineService;
use Illuminate\Http\Request;

class FineController extends Controller
{
    protected FineService $fineService;

    public function __construct(FineService $fineService)
    {
        $this->fineService = $fineService;
    }

    public function index(Request $request)
    {
        $query = Fine::with(['bookIssue.book', 'bookIssue.member']);

        if ($request->filled('payment_status')) {
            match ($request->payment_status) {
                'paid' => $query->paid(),
                'unpaid' => $query->unpaid(),
                default => null,
            };
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $fines = $query->latest()->paginate(15);

        // Totals summary
        $totalFines = Fine::sum('fine_amount');
        $totalCollected = Fine::paid()->sum('fine_amount');
        $totalPending = Fine::unpaid()->sum('fine_amount');

        return view('library.fines.index', compact('fines', 'totalFines', 'totalCollected', 'totalPending'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_issue_id' => 'required|exists:book_issues,id',
            'fine_amount' => 'required|numeric|min:0.01',
            'fine_reason' => 'required|string|max:255',
        ]);

        Fine::create([
            'institute_id' => auth()->user()->institute_id,
            'book_issue_id' => $validated['book_issue_id'],
            'fine_amount' => $validated['fine_amount'],
            'fine_reason' => $validated['fine_reason'],
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('library.fines.index')->with('success', 'Fine added successfully.');
    }

    public function collectFine(Fine $fine)
    {
        $this->fineService->collectFine($fine);

        return redirect()->route('library.fines.index')->with('success', 'Fine collected successfully.');
    }
}
