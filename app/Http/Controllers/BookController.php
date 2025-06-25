<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index', [
            'books' => Book::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request) : RedirectResponse
    {
        Book::create($request->validated());
        return redirect()->route('books.index')->withSuccess('New Book is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book) : View
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());
        return redirect()->back()->withSuccess('Book is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book) : RedirectResponse
    {
        $book->delete();
        return redirect()->route('books.index')->withSuccess('Book is deleted successfully.');
    }
}
