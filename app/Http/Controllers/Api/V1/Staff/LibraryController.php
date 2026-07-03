<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $books = collect();
        if (class_exists(\App\Models\Book::class)) {
            $books = \App\Models\Book::all()->map(fn($b) => [
                'id' => $b->id,
                'title' => $b->title,
                'author' => $b->author ?? null,
                'isbn' => $b->isbn ?? null,
                'available_copies' => $b->available_copies ?? 0,
                'total_copies' => $b->total_copies ?? $b->copies ?? 0,
            ])->values();
        }
        return response()->json(['books' => $books]);
    }

    public function issue(Request $request)
    {
        $request->validate(['book_id' => 'required', 'student_id' => 'required', 'due_date' => 'required|date']);
        if (class_exists(\App\Models\BookIssue::class)) {
            \App\Models\BookIssue::create(array_merge($request->all(), [
                'issued_by' => $request->user()->id,
                'issued_at' => now(),
            ]));
        }
        return response()->json(['message' => 'Book issued successfully']);
    }

    public function returnBook(Request $request)
    {
        $request->validate(['issue_id' => 'required']);
        if (class_exists(\App\Models\BookIssue::class)) {
            \App\Models\BookIssue::findOrFail($request->issue_id)->update([
                'returned_at' => now(),
                'returned_to' => $request->user()->id,
            ]);
        }
        return response()->json(['message' => 'Book returned successfully']);
    }
}
