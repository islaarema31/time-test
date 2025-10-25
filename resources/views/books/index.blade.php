@extends('layouts.app')

@section('title', 'Book List - Bookstore Rating System')

@section('content')
    <h1>Book List</h1>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('books.index') }}">
            <label for="show">Show:</label>
            <select name="show" id="show" onchange="this.form.submit()">
                @for($i = 10; $i <= 100; $i += 10)
                    <option value="{{ $i }}" {{ $perPage == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>

            <label for="search">Search:</label>
            <input 
                type="text" 
                name="search" 
                id="search" 
                value="{{ $search }}" 
                placeholder="Book name or author name..."
            >

            <button type="submit">Filter</button>
            
            @if($search)
                <a href="{{ route('books.index') }}" class="btn">Clear</a>
            @endif
        </form>
    </div>

    <!-- Books Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Average Rating</th>
                <th>Total Voters</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $index => $book)
                <tr>
                    <td>{{ $books->firstItem() + $index }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->avg_rating ? number_format($book->avg_rating, 2) : 'No ratings' }}</td>
                    <td>{{ $book->voter_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        {{ $books->links() }}
    </div>

    <p style="margin-top: 20px; color: #666;">
        Showing {{ $books->firstItem() ?? 0 }} to {{ $books->lastItem() ?? 0 }} of {{ $books->total() }} books
    </p>
@endsection