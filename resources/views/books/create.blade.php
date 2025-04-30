<div class="container mx-auto py-8">
    <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST">
        @csrf
        @if(isset($book))
            @method('PUT')
        @endif
        <label class="block">Tên Sách:</label>
        <input type="text" name="title" value="{{ $book->title ?? '' }}" class="border rounded px-4 py-2 w-full">

        <label class="block">Mô tả:</label>
        <textarea name="description" class="border rounded px-4 py-2 w-full">{{ $book->description ?? '' }}</textarea>

        <label class="block">Tác giả:</label>
        <select name="authors[]" multiple class="border rounded px-4 py-2 w-full">
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" {{ isset($book) && $book->authors->contains($author->id) ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-4 rounded">
            {{ isset($book) ? 'Cập nhật' : 'Thêm' }}
        </button>
    </form>
</div>
<div class="container mx-auto">
    <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($book))
            @method('PUT')
        @endif
        <label class="block">Tên Sách:</label>
        <input type="text" name="title" value="{{ $book->title ?? '' }}" class="border rounded px-4 py-2 w-full">

        <label class="block">Mô tả:</label>
        <textarea name="description" class="border rounded px-4 py-2 w-full">{{ $book->description ?? '' }}</textarea>

        <label class="block">Tác giả:</label>
        <select name="authors[]" multiple class="border rounded px-4 py-2 w-full">
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" {{ isset($book) && $book->authors->contains($author->id) ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>

        <label class="block">Hình ảnh:</label>
        <input type="file" name="image" class="border rounded px-4 py-2 w-full">
        @if(isset($book) && $book->image)
            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="mt-4 max-w-xs">
        @endif

        <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-4 rounded">
            {{ isset($book) ? 'Cập nhật' : 'Thêm' }}
        </button>
    </form>
</div>