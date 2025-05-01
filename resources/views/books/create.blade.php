<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6">
        {{ isset($book) ? 'Chỉnh Sửa Sách' : 'Thêm Sách Mới' }}
    </h1>
    <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @if(isset($book))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Tên Sách:</label>
            <input type="text" name="title" id="title" value="{{ $book->title ?? '' }}" class="border rounded px-4 py-2 w-full" placeholder="Nhập tên sách" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Mô Tả:</label>
            <textarea name="description" id="description" class="border rounded px-4 py-2 w-full" placeholder="Nhập mô tả">{{ $book->description ?? '' }}</textarea>
        </div>

        <div class="mb-4">
            <label for="authors" class="block text-gray-700 font-bold mb-2">Tác Giả:</label>
            <select name="authors[]" id="authors" multiple class="border rounded px-4 py-2 w-full">
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ isset($book) && $book->authors->contains($author->id) ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Hình Ảnh:</label>
            <input type="file" name="image" id="image" class="border rounded px-4 py-2 w-full">
            @if(isset($book) && $book->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="max-w-full h-auto rounded shadow">
                </div>
            @endif
        </div>


        <div class="text-center">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($book) ? 'Cập Nhật' : 'Thêm' }}
            </button>
        </div>
    </form>
</div>