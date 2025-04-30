<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold">{{ $author->name }}</h1>
    <h2 class="text-xl font-bold mt-6">Danh sách sách của tác giả:</h2>
    <ul class="list-disc pl-6">
        @foreach ($author->books as $book)
            <li>
                <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">{{ $book->title }}</a>
            </li>
        @endforeach
    </ul>
    <div class="mt-6">
        <a href="{{ route('authors.index') }}" class="text-blue-500">Quay lại danh sách</a>
    </div>
</div>