<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Libretto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand me-4" href="{{ route('books.index') }}">
                    Libretto 'jspeleca12'
                </a>

                @auth
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item me-3"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
                        <li class="nav-item me-3"><a class="nav-link" href="{{ route('authors.index') }}">Authors</a></li>
                        <li class="nav-item me-3"><a class="nav-link" href="{{ route('genres.index') }}">Genres</a></li>
                        <li class="nav-item me-3"><a class="nav-link" href="{{ route('reviews.index') }}">Reviews</a></li>
                    </ul>
                @endauth
            </div>

            <div class="d-flex align-items-center">
                @auth
                    <span class="me-3">Hello, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
