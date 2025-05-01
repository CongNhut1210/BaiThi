<x-app-layout>
    <div class="container mx-auto py-8">
       
        <h1 class="text-3xl font-bold text-center mb-6">{{ $book->title }}</h1>


        <p class="text-gray-700 text-justify my-4">{{ $book->description }}</p>


        <h2 class="text-xl font-bold mt-6">Tác giả:</h2>
        <ul class="list-disc pl-6 mb-6">
            @foreach ($book->authors as $author)
                <li>{{ $author->name }}</li>
            @endforeach
        </ul>


        <div class="mt-6">
            <a href="{{ route('books.index') }}" class="text-blue-500 hover:underline">Quay lại danh sách</a>
        </div>


        <div class="mt-6 flex gap-4">
            <a href="{{ route('books.edit', $book) }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                Sửa
            </a>
            <form method="POST" action="{{ route('books.destroy', $book) }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Xác nhận xoá?')">
                    Xoá
                </button>
            </form>
        </div>
    </div>


    <div class="container mx-auto mt-8">
        <form action="{{ route('books.rate', $book->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            <h2 class="text-xl font-bold mb-4">Đánh giá Sách:</h2>
            <div class="flex items-center gap-4 mb-4">
                <label for="rating" class="block text-gray-700 font-medium">Đánh giá:</label>
                <select name="rating" id="rating" class="border rounded px-4 py-2">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Gửi đánh giá
            </button>
        </form>
    </div>
</x-app-layout>