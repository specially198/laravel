<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $query = Book::orderBy('created_at', 'desc');
        if(!empty($search)) {
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere("author", "LIKE", "%{$search}%")
                ->orWhere("memo", "LIKE", "%{$search}%");
        }
        $books = $query->paginate(10);

        return view('books.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|integer|digits_between:1,2',
            'author' => 'nullable|string',
            'purchase_date' => 'nullable|date|before_or_equal:today',
            'evaluation' => 'nullable|integer|between:1,5',
            'img_file' => 'image|max:2048',
            'memo' => 'nullable|string',
        ]);

        $inputs = $request->all();

        // 画像ファイルを保存
        $img_file = $request->file('img_file');
        if ($img_file != null) {
            $img_file_name = $img_file->getClientOriginalName();
            $img_file->storeAs('public', $img_file_name);
            $inputs['img_file_name'] = $img_file_name;
        }

        Book::create($inputs);
        return Redirect::route('books.index')->with('status', 'books-stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|integer|digits_between:1,2',
            'author' => 'nullable|string',
            'purchase_date' => 'nullable|date|before_or_equal:today',
            'evaluation' => 'nullable|integer|between:1,5',
            'img_file' => 'image|max:2048',
            'memo' => 'nullable|string',
        ]);

        $inputs = $request->all();

        // 画像ファイルを保存
        $img_file = $request->file('img_file');
        if ($img_file != null) {
            // 旧ファイルを削除
            if (!empty($book->img_file_name)) {
                Storage::delete('public/'.$book->img_file_name);
            }

            $img_file_name = $img_file->getClientOriginalName();
            $img_file->storeAs('public', $img_file_name);
            $inputs['img_file_name'] = $img_file_name;
        } else {
            Storage::delete('public/'.$book->img_file_name);
            $inputs['img_file_name'] = null;
        }

        $book->update($inputs);

        return Redirect::route('books.index')->with('status', 'books-updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return Redirect::route('books.index')->with('status', 'books-deleted');
    }
}
