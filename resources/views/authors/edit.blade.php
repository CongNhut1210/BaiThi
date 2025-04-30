<div class="container mx-auto">
    <form action="{{ isset($author) ? route('authors.update', $author->id) : route('authors.store') }}" method="POST">
        @csrf
        @if(isset($author))
            @method('PUT')
        @endif
        <label class="block">Tên Tác giả:</label>
        <input type="text" name="name" value="{{ $author->name ?? '' }}" class="border rounded px-4 py-2 w-full">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-4 rounded">
            {{ isset($author) ? 'Cập nhật' : 'Thêm' }}
        </button>
    </form>
</div>