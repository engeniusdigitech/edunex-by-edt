<?php

namespace App\Services\Library;

use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\Library\Fine;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class ReportService
{
    /**
     * Book inventory report — books with total/available/issued counts, filterable by category.
     */
    public function bookInventory(Request $request)
    {
        $query = Book::with(['category', 'author', 'publisher'])
            ->selectRaw('library_books.*, (total_copies - available_copies) as issued_copies');

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($search = $request->input('search')) {
            $query->search($search);
        }

        return $query->latest()->paginate(15)->withQueryString();
    }

    /**
     * Currently issued books with member info, filterable by date range, category, batch.
     */
    public function issuedBooks(Request $request)
    {
        $query = BookIssue::with(['book.category', 'member', 'issuedByUser'])
            ->where('status', 'issued');

        if ($dateFrom = $request->input('date_from')) {
            $query->where('issue_date', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->where('issue_date', '<=', $dateTo);
        }

        if ($categoryId = $request->input('category_id')) {
            $query->whereHas('book', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        if ($batchId = $request->input('batch_id')) {
            $query->where('member_type', Student::class)
                ->whereHas('member', function ($q) use ($batchId) {
                    $q->where('batch_id', $batchId);
                });
        }

        if ($search = $request->input('search')) {
            $query->whereHas('book', function ($q) use ($search) {
                $q->search($search);
            });
        }

        return $query->latest('issue_date')->paginate(15)->withQueryString();
    }

    /**
     * Returned books report, filterable by date range.
     */
    public function returnedBooks(Request $request)
    {
        $query = BookIssue::with(['book.category', 'member', 'returnedByUser'])
            ->where('status', 'returned');

        if ($dateFrom = $request->input('date_from')) {
            $query->where('return_date', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->where('return_date', '<=', $dateTo);
        }

        if ($categoryId = $request->input('category_id')) {
            $query->whereHas('book', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        if ($search = $request->input('search')) {
            $query->whereHas('book', function ($q) use ($search) {
                $q->search($search);
            });
        }

        return $query->latest('return_date')->paginate(15)->withQueryString();
    }

    /**
     * Overdue books report with fine calculation.
     */
    public function overdueBooks(Request $request)
    {
        $query = BookIssue::with(['book.category', 'member', 'fines'])
            ->overdue();

        if ($search = $request->input('search')) {
            $query->whereHas('book', function ($q) use ($search) {
                $q->search($search);
            });
        }

        return $query->orderBy('due_date')->paginate(15)->withQueryString();
    }

    /**
     * Fine collection summary with totals.
     */
    public function fineCollection(Request $request)
    {
        $query = Fine::with(['bookIssue.book', 'bookIssue.member']);

        if ($status = $request->input('payment_status')) {
            $query->where('payment_status', $status);
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->where('created_at', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->where('created_at', '<=', $dateTo . ' 23:59:59');
        }

        if ($search = $request->input('search')) {
            $query->whereHas('bookIssue.book', function ($q) use ($search) {
                $q->search($search);
            });
        }

        $paginated = $query->latest()->paginate(15)->withQueryString();

        // Attach summary totals to the paginator
        $allFinesQuery = clone $query;
        $paginated->totalFines = $allFinesQuery->sum('fine_amount');
        $paginated->totalCollected = (clone $allFinesQuery)->where('payment_status', 'paid')->sum('fine_amount');
        $paginated->totalPending = (clone $allFinesQuery)->where('payment_status', 'unpaid')->sum('fine_amount');

        return $paginated;
    }

    /**
     * Lost books report.
     */
    public function lostBooks(Request $request)
    {
        $query = BookIssue::with(['book.category', 'member', 'issuedByUser'])
            ->where('status', 'lost');

        if ($search = $request->input('search')) {
            $query->whereHas('book', function ($q) use ($search) {
                $q->search($search);
            });
        }

        return $query->latest()->paginate(15)->withQueryString();
    }

    /**
     * Most borrowed books — ordered by total issue count.
     */
    public function mostBorrowed(Request $request)
    {
        $query = Book::withCount('bookIssues')
            ->with(['category', 'author']);

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        return $query->orderByDesc('book_issues_count')
            ->paginate(15)
            ->withQueryString();
    }

    /**
     * Member-wise report — student or staff report with issue/fine data.
     */
    public function memberReport(string $type, Request $request)
    {
        if ($type === 'student') {
            return $this->studentMemberReport($request);
        }

        return $this->staffMemberReport($request);
    }

    /**
     * Student-wise borrowing report.
     */
    protected function studentMemberReport(Request $request)
    {
        $query = Student::withCount([
                'bookIssues as total_issues',
                'bookIssues as active_issues' => function ($q) {
                    $q->where('status', 'issued');
                },
            ])
            ->with('batch');

        if ($batchId = $request->input('batch_id')) {
            $query->where('batch_id', $batchId);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(15)->withQueryString();
    }

    /**
     * Staff-wise borrowing report.
     */
    protected function staffMemberReport(Request $request)
    {
        $staffRoles = ['Teacher', 'Receptionist', 'Principal', 'Librarian'];

        $query = User::whereHas('role', function ($q) use ($staffRoles) {
                $q->whereIn('name', $staffRoles);
            })
            ->withCount([
                'bookIssues as total_issues',
                'bookIssues as active_issues' => function ($q) {
                    $q->where('status', 'issued');
                },
            ])
            ->with('role');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate(15)->withQueryString();
    }
}
