<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold">{{ $book->title }}</h1>
        <p class="text-gray-700 my-4">{{ $book->description }}</p>
        <h2 class="text-xl font-bold mt-6">Tác giả:</h2>
        <ul class="list-disc pl-6">
            @foreach ($book->authors as $author)
                <li>{{ $author->name }}</li>
            @endforeach
            </ul>
        </div>
        <div class="mt-6">
            <a href="{{ route('books.index') }}" class="text-blue-500">Quay lại danh sách</a>
        </div>
        <div class="mt-6 flex gap-2">
            <a href="{{ route('books.edit', $book) }}" class="bg-yellow-400 px-4 py-2 rounded">Sửa</a>
            <form method="POST" action="{{ route('books.destroy', $book) }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Xác nhận xoá?')">Xoá</button>
            </form>
        </div>
    </div>
    <form action="{{ route('books.rate', $book->id) }}" method="POST">
        @csrf
        <label>Đánh giá:</label>
        <select name="rating" class="border rounded px-4 py-2">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Gửi đánh giá</button>
    </form>
</x-app-layout>
