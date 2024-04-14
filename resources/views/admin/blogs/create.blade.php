@extends('admin.layouts.admin')

@section('title', 'Create Blog')

@section('content')
    <h1>Create New Blog</h1>

    <form action="{{ route('admin.blogs.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="4" required></textarea>
        </div>
        <div>
            <label>Categories:</label><br>
            @foreach($categories as $category)
                <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                <label>{{ $category->name }}</label><br>
            @endforeach
        </div>
        <button type="submit">Create</button>
    </form>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection



<h2><a href="{{ route('admin.blogs.index') }}">Back to all blogs</a></h2>
