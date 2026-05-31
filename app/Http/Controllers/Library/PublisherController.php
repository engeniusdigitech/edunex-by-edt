<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\StorePublisherRequest;
use App\Models\Library\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::withCount('books')->latest()->paginate(15);

        return view('library.publishers.index', compact('publishers'));
    }

    public function store(StorePublisherRequest $request)
    {
        Publisher::create($request->validated());

        return redirect()->route('library.publishers.index')->with('success', 'Publisher created successfully.');
    }

    public function update(StorePublisherRequest $request, Publisher $publisher)
    {
        $publisher->update($request->validated());

        return redirect()->route('library.publishers.index')->with('success', 'Publisher updated successfully.');
    }

    public function destroy(Publisher $publisher)
    {
        if ($publisher->books()->exists()) {
            return redirect()->route('library.publishers.index')
                ->with('error', 'Cannot delete publisher with associated books.');
        }

        $publisher->delete();

        return redirect()->route('library.publishers.index')->with('success', 'Publisher deleted successfully.');
    }
}
