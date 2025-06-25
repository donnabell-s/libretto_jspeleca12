@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">Book Information</div>
                <div class="float-end">
                    <a href="{{ route('reviews.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-start">
                    <div class="col-md-8">
                        <div class="row mb-2">
                            <label for="book_id" class="col-md-4 col-form-label text-md-end text-start"><strong>Book:</strong></label>
                            <div class="col-md-8" style="line-height:35px;">
                                {{ $review->book_id }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="content" class="col-md-4 col-form-label text-md-end text-start"><strong>Content:</strong></label>
                            <div class="col-md-8" style="line-height:35px;">
                                {{ $review->content}}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="rating" class="col-md-4 col-form-label text-md-end text-start"><strong>Rating:</strong></label>
                            <div class="col-md-8" style="line-height:35px;">
                                {{ $review->rating }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
