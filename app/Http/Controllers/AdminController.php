<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;

class AdminController extends Controller
{
    // Chỉ admin mới có thể truy cập các phương thức này
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    // Trang Dashboard chính
    public function index()
    {
        $totalBooks = Book::count();
        $totalAuthors = Author::count();
        return view('admin.dashboard', compact('totalBooks', 'totalAuthors'));
    }
}