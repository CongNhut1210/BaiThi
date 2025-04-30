<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">
        <h1 class="text-xl font-bold mb-4">{{ isset($book) ? 'Sửa sách' : 'Thêm sách' }}</h1>
        <form method="POST" action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}">
            @csrf
            @if(isset($book))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Tên sách</label>
                <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}"
                    class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Mô tả</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg">{{ old('description', $book->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Chọn tác giả</label>
                @foreach($authors as $author)
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="authors[]" value="{{ $author->id }}"
                            {{ (isset($book) && $book->authors->contains($author->id)) ? 'checked' : '' }}
                            class="mr-2">
                        {{ $author->name }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                {{ isset($book) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
        </form>
    </div>
</x-app-layout>
