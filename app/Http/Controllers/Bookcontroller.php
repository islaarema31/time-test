<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of books with filters.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('show', 10);
        $search = $request->input('search', '');

        // Subquery untuk mendapatkan rating statistics per book
        $ratingsSubquery = DB::table('ratings')
            ->select('book_id')
            ->selectRaw('AVG(rating) as avg_rating')
            ->selectRaw('COUNT(id) as voter_count')
            ->groupBy('book_id');

        // Main query dengan LEFT JOIN ke subquery
        $query = Book::query()
            ->with(['author', 'category'])
            ->leftJoinSub($ratingsSubquery, 'rating_stats', function($join) {
                $join->on('books.id', '=', 'rating_stats.book_id');
            })
            ->select('books.*')
            ->selectRaw('COALESCE(rating_stats.avg_rating, 0) as avg_rating')
            ->selectRaw('COALESCE(rating_stats.voter_count, 0) as voter_count');

        // Add search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('books.title', 'like', "%{$search}%")
                  ->orWhereHas('author', function($authorQuery) use ($search) {
                      $authorQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Order by average rating (highest to lowest)
        $query->orderByRaw('avg_rating DESC')
              ->orderBy('books.title');

        // Paginate results
        $books = $query->paginate($perPage)->withQueryString();

        return view('books.index', compact('books', 'perPage', 'search'));
    }
}