<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReadingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReadingHistoriesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        return view('reading_histories.create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'finished_date' => 'nullable|date|before_or_equal:today',
            'evaluation' => 'nullable|integer|between:1,5',
            'thoughts' => 'nullable|string',
        ]);

        $book->readingHistories()->create($request->all());
        return Redirect::route('books.show', $book)->with('status', 'reading_histories-stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\ReadingHistory  $reading_history
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, ReadingHistory $reading_history)
    {
        return view('reading_histories.show', [
            'book' => $book,
            'reading_history' => $reading_history,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\ReadingHistory  $reading_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, ReadingHistory $reading_history)
    {
        return view('reading_histories.edit', [
            'book' => $book,
            'reading_history' => $reading_history,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @param  \App\Models\ReadingHistory  $reading_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, ReadingHistory $reading_history)
    {
        $request->validate([
            'finished_date' => 'nullable|date|before_or_equal:today',
            'evaluation' => 'nullable|integer|between:1,5',
            'thoughts' => 'nullable|string',
        ]);

        $reading_history->update($request->all());
        return Redirect::route('books.show', $book)->with('status', 'reading_histories-updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @param  \App\Models\ReadingHistory  $reading_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, ReadingHistory $reading_history)
    {
        $reading_history->delete();
        return Redirect::route('books.show', $book)->with('status', 'reading_histories-deleted');
    }
}
