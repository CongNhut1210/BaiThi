<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Container\Attributes\Auth;

class BookController extends Controller
{

    public function index()
    {
        return Book::with('authors')->get();
    }

    public function show(Book $book)
    {
        return $book->load('authors');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
