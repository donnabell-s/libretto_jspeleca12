@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Book
                </div>
                <div class="float-end">
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}"
                    method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="code" class="col-md-4 col-formlabel text-md-end text-start">Book Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="quantity" class="col-md-4 colform-label text-md-end text-start">Author ID</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('author_id') is-invalid @enderror" id="author_id" name="author_id"
                                value="{{ old('author_id') }}">
                            @error('author_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection