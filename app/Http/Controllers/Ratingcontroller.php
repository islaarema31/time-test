<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Show the form for creating a new rating.
     */
    public function create()
    {
        // Get all authors for dropdown
        $authors = Author::orderBy('name')->get();
        
        return view('ratings.create', compact('authors'));
    }

    /**
     * Store a newly created rating in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        // Verify that the book belongs to the selected author
        $book = Book::where('id', $request->book_id)
                    ->where('author_id', $request->author_id)
                    ->firstOrFail();

        // Create the rating
        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.index')
                        ->with('success', 'Rating submitted successfully!');
    }

    /**
     * Get books by author (AJAX endpoint)
     */
    public function getBooksByAuthor(Request $request)
    {
        $authorId = $request->input('author_id');
        
        if (!$authorId) {
            return response()->json([]);
        }

        $books = Book::where('author_id', $authorId)
                    ->orderBy('title')
                    ->get(['id', 'title']);

        return response()->json($books);
    }
}