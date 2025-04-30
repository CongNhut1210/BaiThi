@extends('layouts.app')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6"> <a href="{{ route('books.index') }}">Danh sách sách</a></h1>
    <a href="{{ route('books.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm sách</a>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($books as $book)
            <li class="mb-2">
                <h2 class="text-xl">{{ $book->title }}</h2>
                <p>{{ $book->description }}</p>
                <h3>Tác giả:</h3>
                <ul>
                    @foreach ($book->authors as $author)
                        <li>{{ $author->name }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500">Sửa</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Xóa</button>
                </form>
            </li>
        @endforeach
    </div>
</div>
<div class="container mx-auto">
    @foreach ($books as $book)
        <div class="border rounded p-4 mb-4">
            <h2 class="text-xl font-bold">{{ $book->title }}</h2>
            <p>{{ $book->description }}</p>
            <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">Xem chi tiết</a>
        </div>
    @endforeach

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
<div class="container mx-auto mb-4">
    <form action="{{ route('books.index') }}" method="GET">
        <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Tìm kiếm sách..." class="border rounded px-4 py-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Tìm kiếm</button>
    </form>
</div>

@foreach ($books as $book)
    <div class="border rounded p-4 mb-4">
        <h2 class="text-xl font-bold">{{ $book->title }}</h2>
        <p>{{ $book->description }}</p>
        <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">Xem chi tiết</a>
    </div>
@endforeach
<div class="mt-4">
    {{ $books->links() }}
</div>
<div class="container mx-auto mb-4">
    <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nhập file CSV:</label>
        <input type="file" name="file" class="border rounded px-4 py-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Nhập</button>
    </form>
</div>
<div class="container mx-auto">
    @foreach ($books as $book)
        <div class="border rounded p-4 mb-4">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="max-w-xs mb-4">
            @endif
            <h2 class="text-xl font-bold">{{ $book->title }}</h2>
            <p>{{ $book->description }}</p>
            <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">Xem chi tiết</a>
        </div>
    @endforeach
</div>

@foreach ($books as $book)
    <form action="{{ route('books.favorite', $book->id) }}" method="POST">
        @csrf
        <button type="submit">Thêm vào yêu thích</button>
    </form>
<form action="{{ route('books.unfavorite', $book->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-gray-500 text-white px-4 py-2">Xóa khỏi yêu thích</button>
</form>
@endforeach