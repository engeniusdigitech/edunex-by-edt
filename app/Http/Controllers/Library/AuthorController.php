<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\StoreAuthorRequest;
use App\Models\Library\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->latest()->paginate(15);

        return view('library.authors.index', compact('authors'));
    }

    public function store(StoreAuthorRequest $request)
    {
        Author::create($request->validated());

        return redirect()->route('library.authors.index')->with('success', 'Author created successfully.');
    }

    public function update(StoreAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('library.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        if ($author->books()->exists()) {
            return redirect()->route('library.authors.index')
                ->with('error', 'Cannot delete author with associated books.');
        }

        $author->delete();

        return redirect()->route('library.authors.index')->with('success', 'Author deleted successfully.');
    }
}
