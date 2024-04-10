@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <h1>Categories</h1>

    <h2><a href="{{ route('dashboard') }}">Back to Dashboard</a></h2>


    <a href="{{ route('admin.categories.create') }}">Create New Category</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
