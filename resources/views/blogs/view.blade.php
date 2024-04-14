@extends('layouts.main')

@section('title', 'Blogs View')

@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <a href="{{ route('categories.index') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Categories</a>
            <a href="{{ route('blogs.index') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Blogs</a>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth

        </div>
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6" style="color: white">
            Categories:
            @if($blog->categories->count())
                @foreach($blog->categories as $category)
                    <a href="{{ route('categories.view', $category->id) }}">| {{ $category->name }} |</a>
                @endforeach
            @endif
        </div>
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                @if($blog->count())
                    <div class="p-6" style="color: white">
                        {{ $blog->title }}
                    </div>
                    <div class="p-6" style="color: white">
                        {{ $blog->content }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
