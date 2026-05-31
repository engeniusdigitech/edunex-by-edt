<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\Library\Category;
use App\Models\Library\Fine;
use App\Models\Library\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('available_copies', '>', 0)->count();
        $issuedBooks = BookIssue::active()->count();
        $overdueBooks = BookIssue::overdue()->count();
        $finesCollected = Fine::paid()->sum('fine_amount');
        $pendingFines = Fine::unpaid()->sum('fine_amount');
        $totalReservations = Reservation::pending()->count();
        $recentlyIssuedBooks = BookIssue::with(['book', 'member'])->latest()->take(10)->get();
        $recentlyAddedBooks = Book::with(['category', 'author'])->latest()->take(10)->get();

        // Chart data
        $booksByCategory = Category::withCount('books')->get()->pluck('books_count', 'name');
        $monthlyIssues = BookIssue::selectRaw('MONTH(issue_date) as month, COUNT(*) as count')
            ->whereYear('issue_date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [date('M', mktime(0, 0, 0, $item->month, 10)) => $item->count];
            });

        return view('library.dashboard', compact(
            'totalBooks',
            'availableBooks',
            'issuedBooks',
            'overdueBooks',
            'finesCollected',
            'pendingFines',
            'totalReservations',
            'recentlyIssuedBooks',
            'recentlyAddedBooks',
            'booksByCategory',
            'monthlyIssues'
        ));
    }
}
