<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reviews.index', [
            'reviews' => Review::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::orderBy('title')->get();
        // $reviews = Review::select('rating')->distinct()->orderBy('rating')->get();
        return view('reviews.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request) : RedirectResponse
    {
        Review::create($request->validated());
        return redirect()->route('reviews.index')->withSuccess('New Review is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review) : View
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Review $review)
    {
        $books = Book::orderBy('title')->get();
        return view('reviews.edit', compact('review', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review): RedirectResponse
    {
        $review->update($request->validated());
        return redirect()->back()->withSuccess('Review is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review) : RedirectResponse
    {
        $review->delete();
        return redirect()->route('reviews.index')->withSuccess('Review is deleted successfully.');
    }
}
