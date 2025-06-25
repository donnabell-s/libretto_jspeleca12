<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authors.index', [
            'authors' => Author::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request) : RedirectResponse
    {
        Author::create($request->validated());
        return redirect()->route('authors.index')->withSuccess('New Author is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author) : View
    {
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author) : RedirectResponse
    {
        $author->update($request->validated());
        return redirect()->route('authors.index')->withSuccess('Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author) : RedirectResponse
    {
        $author->delete();
        return redirect()->route('authors.index')->withSuccess('Author deleted successfully.');
    }
}
