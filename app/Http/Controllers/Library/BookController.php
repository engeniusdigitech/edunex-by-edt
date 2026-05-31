<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\StoreBookRequest;
use App\Http\Requests\Library\UpdateBookRequest;
use App\Models\Library\Author;
use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\Library\Category;
use App\Models\Library\Publisher;
use App\Services\Library\BookService;
use App\Exports\Library\BooksExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Milon\Barcode\DNS1D;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        $books = $this->bookService->list($request);
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('library.books.index', compact('books', 'categories', 'authors'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('library.books.create', compact('categories', 'authors', 'publishers'));
    }

    public function store(StoreBookRequest $request)
    {
        $this->bookService->create($request->validated());

        return redirect()->route('library.books.index')->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'author', 'publisher']);
        $recentIssues = BookIssue::with('member')
            ->where('book_id', $book->id)
            ->latest()
            ->take(10)
            ->get();

        return view('library.books.show', compact('book', 'recentIssues'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        return view('library.books.edit', compact('book', 'categories', 'authors', 'publishers'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->bookService->update($book, $request->validated());

        return redirect()->route('library.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        try {
            $this->bookService->delete($book);
        } catch (\Exception $e) {
            return redirect()->route('library.books.index')->with('error', $e->getMessage());
        }

        return redirect()->route('library.books.index')->with('success', 'Book deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:books,id',
        ]);

        try {
            $this->bookService->bulkDelete($request->ids);
        } catch (\Exception $e) {
            return redirect()->route('library.books.index')->with('error', $e->getMessage());
        }

        return redirect()->route('library.books.index')->with('success', 'Selected books deleted successfully.');
    }

    public function exportCsv(Request $request)
    {
        $books = $this->bookService->list($request, paginate: false);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="books_' . now()->format('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($books) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Title', 'ISBN', 'Author', 'Category', 'Publisher', 'Total Copies', 'Available Copies', 'Price']);

            foreach ($books as $book) {
                fputcsv($file, [
                    $book->title,
                    $book->isbn,
                    $book->author->name ?? '',
                    $book->category->name ?? '',
                    $book->publisher->name ?? '',
                    $book->total_copies,
                    $book->available_copies,
                    $book->price,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new BooksExport(), 'books_' . now()->format('Y-m-d') . '.xlsx');
    }

    public function printQR(Book $book)
    {
        $qrCode = QrCode::size(200)->generate(json_encode([
            'id' => $book->id,
            'isbn' => $book->isbn,
            'title' => $book->title,
        ]));

        return view('library.books.print-qr', compact('book', 'qrCode'));
    }

    public function printBarcode(Book $book)
    {
        $barcode = (new DNS1D())->getBarcodeHTML($book->isbn ?: (string) $book->id, 'C128', 2, 60);

        return view('library.books.print-barcode', compact('book', 'barcode'));
    }

    public function scanSearch(Request $request)
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
        ]);
    }
}
