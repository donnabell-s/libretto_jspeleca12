@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Review
                </div>
                <div class="float-end">
                    <a href="{{ route('reviews.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('reviews.store') }}"
                    method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="book_id" class="col-md-4 col-form-label text-md-end text-start">Book</label>
                        <div class="col-md-6">
                            <select class="form-select @error('book_id') is-invalid @enderror" id="book_id" name="book_id">
                                <option value="">-- Select Book --</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="content" class="col-md-4 col-form-label text-md-end text-start">Content</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" value="{{ old('content') }}">
                            @error('content')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="book_id" class="col-md-4 col-form-label text-md-end text-start">Rating</label>
                        <div class="col-md-6">
                            <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating">
                                <option value="">-- Select Rating --</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('review_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Add Review</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection