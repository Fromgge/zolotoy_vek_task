@extends('admin.layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Blog</h1>
    <h2><a href="{{ route('admin.categories.index') }}">Back to all categories</a></h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
