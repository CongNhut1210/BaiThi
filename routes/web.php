<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Http\Controllers\AdminController;



Route::get('/dashboard', function () {
    $totalBooks = Book::count();
    $totalAuthors = Author::count();
    return view('dashboard', compact('totalBooks', 'totalAuthors'));
})->name('dashboard');
Route::get('/books',[BookController::class ,'index'])->name('books.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);

});
Route::get('/books/export', [BookController::class, 'export'])->name('books.export');
Route::post('/books/import', [BookController::class, 'import'])->name('books.import');

Route::middleware(['role:admin'])->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
});

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);

Route::post('/books/{book}/favorite', [BookController::class, 'favorite'])->name('books.favorite');
Route::delete('/books/{book}/favorite', [BookController::class, 'unfavorite'])->name('books.unfavorite');
Route::post('/books/{book}/rate', [BookController::class, 'rate'])->name('books.rate');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
require __DIR__.'/auth.php';
