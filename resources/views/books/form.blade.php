<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">

        <h1 class="text-2xl font-bold text-center mb-6">
            {{ isset($book) ? 'Chỉnh Sửa Sách' : 'Thêm Sách Mới' }}
        </h1>

        <form method="POST" action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}" class="bg-white p-6 rounded-lg shadow-lg" enctype="multipart/form-data">
            @csrf
            @if(isset($book))
                @method('PUT')
            @endif


            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Tên Sách:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title ?? '') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Nhập tên sách" required>
            </div>


            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô Tả:</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Nhập mô tả sách">{{ old('description', $book->description ?? '') }}</textarea>
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Chọn Tác Giả:</label>
                <div class="flex flex-wrap">
                    @foreach($authors as $author)
                        <label class="inline-flex items-center mr-4 mb-2">
                            <input type="checkbox" name="authors[]" value="{{ $author->id }}"
                                   {{ (isset($book) && $book->authors->contains($author->id)) ? 'checked' : '' }}
                                   class="mr-2 rounded border-gray-300">
                            {{ $author->name }}
                        </label>
                    @endforeach
                </div>
            </div>


            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Hình Ảnh:</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-lg">
                @if(isset($book) && $book->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="max-w-full h-auto rounded shadow">
                    </div>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    {{ isset($book) ? 'Cập Nhật' : 'Thêm Mới' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>