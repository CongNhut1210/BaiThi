<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Container\Attributes\Auth;
use App\Models\Author;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class BookController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');
    $books = Book::with('authors')
        ->where('title', 'like', "%{$query}%")
        ->paginate(10);

    return view('books.index', compact('books', 'query'));
}
public function show($id)
{
    $book = Book::find($id); // Lấy thông tin sách theo ID
    if (!$book) {
        abort(404, 'Sách không tồn tại!');
    }
    return view('books.show', compact('book')); // Truyền biến $book vào view
}
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'authors' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $book = Book::create(array_merge($request->only('title', 'description'), ['image' => $imagePath]));
        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')->with('success', 'Sách đã được thêm thành công!');
    }
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'authors' => 'required|array',
        ]);

        $book->update($request->only('title', 'description'));
        $book->authors()->sync($request->authors);
        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
    public function export()
{
    $books = Book::with('authors')->get();
    $csvHeader = ['ID', 'Title', 'Description', 'Authors'];
    $csvData = [];

    foreach ($books as $book) {
        $authors = $book->authors->pluck('name')->join(', ');
        $csvData[] = [$book->id, $book->title, $book->description, $authors];
    }

    $filename = "books_" . date('Y-m-d_H-i-s') . ".csv";
    $handle = fopen($filename, 'w');
    fputcsv($handle, $csvHeader);

    foreach ($csvData as $row) {
        fputcsv($handle, $row);
    }

    fclose($handle);
    return response()->download($filename)->deleteFileAfterSend(true);
}
public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,txt',
    ]);

    $file = fopen($request->file('file')->getRealPath(), 'r');
    $header = fgetcsv($file);

    while (($row = fgetcsv($file)) !== false) {
        $book = Book::create([
            'title' => $row[1],
            'description' => $row[2],
        ]);

        $authorNames = explode(',', $row[3]);
        $authors = Author::whereIn('name', $authorNames)->get();
        $book->authors()->sync($authors->pluck('id')->toArray());
    }

    fclose($file);
    return redirect()->route('books.index')->with('success', 'Dữ liệu đã được nhập thành công!');
}
public function favorite(Book $book)
{
    $user = Auth::user();
    $user->favorites()->attach($book->id);
    return redirect()->back()->with('success', 'Sách đã được thêm vào danh sách yêu thích!');
}

public function unfavorite(Book $book)
{
    $user = Auth::user();
    $user->favorites()->detach($book->id);
    return redirect()->back()->with('success', 'Sách đã được xóa khỏi danh sách yêu thích!');
}
public function rate(Request $request, Book $book)
{
    $request->validate(['rating' => 'required|integer|min:1|max:5']);
    $user = Auth::user();

    $user->ratings()->updateOrCreate(
        ['book_id' => $book->id],
        ['rating' => $request->rating]
    );

    return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá!');
}
}

