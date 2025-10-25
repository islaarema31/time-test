@extends('layouts.app')

@section('title', 'Add Rating - Bookstore Rating System')

@section('content')
    <h1>Add Rating</h1>

    <form method="POST" action="{{ route('ratings.store') }}">
        @csrf

        <!-- Author Selection -->
        <div class="form-group">
            <label for="author_id">Select Author *</label>
            <select name="author_id" id="author_id" required>
                <option value="">-- Select Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Book Selection (dynamically populated) -->
        <div class="form-group">
            <label for="book_id">Select Book *</label>
            <select name="book_id" id="book_id" required disabled>
                <option value="">-- Select Author First --</option>
            </select>
            @error('book_id')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Rating Selection -->
        <div class="form-group">
            <label for="rating">Select Rating (1-10) *</label>
            <select name="rating" id="rating" required>
                <option value="">-- Select Rating --</option>
                @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            @error('rating')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn">Submit Rating</button>
    </form>

    <script>
        // Get CSRF token from meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Author selection change event
        document.getElementById('author_id').addEventListener('change', function() {
            const authorId = this.value;
            const bookSelect = document.getElementById('book_id');
            
            // Clear and disable book dropdown
            bookSelect.innerHTML = '<option value="">-- Loading... --</option>';
            bookSelect.disabled = true;

            if (!authorId) {
                bookSelect.innerHTML = '<option value="">-- Select Author First --</option>';
                return;
            }

            // Fetch books by author
            fetch(`{{ route('api.books.by.author') }}?author_id=${authorId}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(books => {
                bookSelect.innerHTML = '<option value="">-- Select Book --</option>';
                
                if (books.length === 0) {
                    bookSelect.innerHTML = '<option value="">-- No books found --</option>';
                } else {
                    books.forEach(book => {
                        const option = document.createElement('option');
                        option.value = book.id;
                        option.textContent = book.title;
                        bookSelect.appendChild(option);
                    });
                    bookSelect.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                bookSelect.innerHTML = '<option value="">-- Error loading books --</option>';
            });
        });
    </script>
@endsection