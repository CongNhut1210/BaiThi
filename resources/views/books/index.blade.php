@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
   
    <h1 class="text-3xl font-bold text-center mb-6">
        <a href="{{ route('books.index') }}">Danh sách Sách</a>
    </h1>


    <a href="{{ route('books.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm sách</a>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($books as $book)
        <div class="border rounded-lg p-4 bg-white shadow">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="max-w-full h-auto rounded mb-4">
            @endif
            <h2 class="text-xl font-bold mb-2">{{ $book->title }}</h2>
            <p class="text-gray-700 mb-4">{{ $book->description }}</p>
            <h3 class="text-md font-semibold">Tác giả:</h3>
            <ul class="mb-4 list-disc pl-6">
                @foreach ($book->authors as $author)
                    <li>{{ $author->name }}</li>
                @endforeach
            </ul>
            <div class="flex justify-between items-center">

                <a href="{{ route('books.edit', $book->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Sửa</a>

                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Xóa</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>


    <div class="mt-8">
        {{ $books->links() }}
    </div>
</div>

<div class="container mx-auto mb-4">
    <form action="{{ route('books.index') }}" method="GET">
        <input type="text" name="query" value="{{ $query ?? '' }}" placeholder="Tìm kiếm sách..."
               class="border rounded px-4 py-2 w-64">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tìm kiếm</button>
    </form>
</div>


<div class="container mx-auto mb-4">
    <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block font-bold text-gray-700 mb-2">Nhập file CSV:</label>
        <input type="file" name="file" class="border rounded px-4 py-2 w-full">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Nhập</button>
    </form>
</div>


<div class="container mx-auto">
    @foreach ($books as $book)
    <div class="border rounded-lg p-4 bg-white shadow mb-4">
        @if($book->image)
            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="max-w-xs mb-4 rounded">
        @endif
        <h2 class="text-xl font-bold">{{ $book->title }}</h2>
        <p class="text-gray-700">{{ $book->description }}</p>
        <a href="{{ route('books.show', $book->id) }}" class="text-blue-500 font-semibold">Xem chi tiết</a>
    </div>
    @endforeach
</div>


@foreach ($books as $book)
<div class="container mx-auto mb-4">
    <form action="{{ route('books.favorite', $book->id) }}" method="POST" class="inline-block">
        @csrf
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Thêm vào Yêu thích</button>
    </form>
    <form action="{{ route('books.unfavorite', $book->id) }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">Xóa khỏi Yêu thích</button>
    </form>
</div>
@endforeach
@endsection