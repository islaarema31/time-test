<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display top 10 most famous authors.
     * Only counts ratings greater than 5.
     */
    public function topAuthors()
    {
        // Subquery untuk menghitung votes per author (ratings > 5)
        $authorStatsSubquery = DB::table('authors')
            ->join('books', 'authors.id', '=', 'books.author_id')
            ->join('ratings', 'books.id', '=', 'ratings.book_id')
            ->where('ratings.rating', '>', 5)
            ->select('authors.id as author_id')
            ->selectRaw('COUNT(ratings.id) as vote_count')
            ->selectRaw('AVG(ratings.rating) as avg_rating')
            ->groupBy('authors.id');

        // Main query
        $topAuthors = Author::query()
            ->joinSub($authorStatsSubquery, 'author_stats', function($join) {
                $join->on('authors.id', '=', 'author_stats.author_id');
            })
            ->select('authors.*', 'author_stats.vote_count', 'author_stats.avg_rating')
            ->orderBy('author_stats.vote_count', 'DESC')
            ->limit(10)
            ->get();

        return view('authors.top', compact('topAuthors'));
    }
}