<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initialscale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Laravel 11 CRUD Application Tutorial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.11.1/font/bootstrap-icons.css">
</head>
<body> 
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container-fluid d-flex align-items-center justify-content-start">
            {{-- Brand logo and name --}}
            <a class="navbar-brand me-4" href="{{ route('books.index') }}">
                Libretto 'jspeleca12'
            </a>

            <ul class="navbar-nav flex-row">
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ route('books.index') }}">
                        <i class="bi bi-book"></i> Books
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ route('authors.index') }}">
                        <i class="bi bi-person"></i> Authors
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ route('genres.index') }}">
                        <i class="bi bi-person"></i> Genres
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ route('reviews.index') }}">
                        <i class="bi bi-person"></i> Reviews
                    </a>
                </li>

            </ul>
        </div>
    </nav>



    <div class="container">
        <h3 class="mb-3">Simple Laravel 11 CRUD Application Tutorial</h3>

        @yield('content')

        <div class="row justify-content-center text-center mt-3">
            <div class="col-md-12">
                <p>
                    Return to Website: 
                    <a href="https://www.usjr.edu.ph/"><strong>University of San Jose - Recoletos</strong></a>
                </p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html> 