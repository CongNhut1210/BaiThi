<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6">{{ isset($author) ? 'Sửa tác giả' : 'Thêm tác giả' }}</h1>
    <form action="{{ isset($author) ? route('authors.update', $author->id) : route('authors.store') }}" method="POST">
        @csrf
        @if(isset($author))
            @method('PUT')
        @endif
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Tên tác giả:</label>
            <input type="text" name="name" id="name" value="{{ $author->name ?? '' }}" class="border rounded px-4 py-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($author) ? 'Cập nhật' : 'Thêm mới' }}</button>
    </form>
</div>