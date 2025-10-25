@extends('layouts.app')

@section('title', 'Top 10 Authors - Bookstore Rating System')

@section('content')
    <h1>Top 10 Most Famous Authors</h1>
    
    <p style="color: #666; margin-bottom: 20px;">
        Based on votes with rating greater than 5
    </p>

    <!-- Authors Table -->
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Author Name</th>
                <th>Total Votes (Rating > 5)</th>
                <th>Average Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topAuthors as $index => $author)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ number_format($author->vote_count) }}</td>
                    <td>{{ number_format($author->avg_rating, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No authors found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection