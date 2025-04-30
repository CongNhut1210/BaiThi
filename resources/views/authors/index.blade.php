<div class="container mx-auto">
    <a href="{{ route('authors.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Thêm Tác giả</a>
    <ul>
        @foreach ($authors as $author)
            <li class="mb-2">
                <span>{{ $author->name }}</span>
                <a href="{{ route('authors.edit', $author->id) }}" class="text-blue-500">Sửa</a>
                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Xóa</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>