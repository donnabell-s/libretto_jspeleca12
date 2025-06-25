<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('genres.index', [
            'genres' => Genre::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request) : RedirectResponse
    {
        Genre::create($request->validated());
        return redirect()->route('genres.index')->withSuccess('New Genre is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre) : View
    {
        return view('genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre) : RedirectResponse
    {
        $genre->update($request->validated());
        return redirect()->route('genres.index')->withSuccess('Genre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre) : RedirectResponse
    {
        $genre->delete();
        return redirect()->route('genres.index')->withSuccess('Genre deleted successfully.');
    }
}
