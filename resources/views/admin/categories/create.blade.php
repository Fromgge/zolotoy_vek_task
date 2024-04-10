@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
    <h1>Create New Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection


<h2><a href="{{ route('admin.categories.index') }}">Back to all categories</a></h2>
