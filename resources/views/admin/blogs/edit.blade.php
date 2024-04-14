@extends('admin.layouts.admin')

@section('title', 'Edit Blog')

@section('content')
    <h1>Edit Blog</h1>
    <h2><a href="{{ route('admin.blogs.index') }}">Back to all blogs</a></h2>

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="4">{{ old('content', $blog->content) }}</textarea>
        </div>
        <div>
            <label>Categories:</label><br>
            @foreach($categories as $category)
                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                    {{ $blog->categories->contains($category) ? 'checked' : '' }}>
                <label>{{ $category->name }}</label><br>
            @endforeach
        </div>
        <button type="submit">Update</button>
    </form>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
