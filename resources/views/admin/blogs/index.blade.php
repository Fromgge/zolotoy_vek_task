@extends('admin.layouts.admin')

@section('title', 'Blogs')

@section('content')
    <h1>Blogs</h1>

    <h2><a href="{{ route('dashboard') }}">Back to Dashboard</a></h2>


    <a href="{{ route('admin.blogs.create') }}">Create New Blog</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->created_at }}</td>
                <td>
                    <a href="{{ route('admin.blogs.edit', $blog->id) }}">Edit</a>
                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST">
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
