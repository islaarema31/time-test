<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bookstore Rating System')</title>
    
    <!-- Simple CSS for readable layout -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1, h2 {
            color: #333;
            margin-bottom: 20px;
        }
        
        nav {
            background: #333;
            color: white;
            padding: 15px;
            margin: -20px -20px 20px -20px;
            border-radius: 5px 5px 0 0;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            padding: 5px 10px;
        }
        
        nav a:hover {
            background: #555;
            border-radius: 3px;
        }
        
        nav a.active {
            background: #555;
            border-radius: 3px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        table tr:hover {
            background-color: #f5f5f5;
        }
        
        .filter-section {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .filter-section label {
            display: inline-block;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .filter-section input,
        .filter-section select {
            padding: 8px;
            margin-right: 15px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        
        .filter-section button {
            padding: 8px 15px;
            background: #333;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .filter-section button:hover {
            background: #555;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group select,
        .form-group input {
            width: 100%;
            max-width: 400px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        
        .btn {
            padding: 10px 20px;
            background: #333;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            background: #555;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .pagination {
            margin-top: 20px;
            display: flex;
            gap: 5px;
        }
        
        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            border-radius: 3px;
        }
        
        .pagination a:hover {
            background: #f5f5f5;
        }
        
        .pagination .active {
            background: #333;
            color: white;
        }
        
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.index') ? 'active' : '' }}">
                Book List
            </a>
            <a href="{{ route('authors.top') }}" class="{{ request()->routeIs('authors.top') ? 'active' : '' }}">
                Top 10 Authors
            </a>
            <a href="{{ route('ratings.create') }}" class="{{ request()->routeIs('ratings.create') ? 'active' : '' }}">
                Add Rating
            </a>
        </nav>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>