@extends('layouts.main')

@section('title', 'Categories')

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
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-gray-900 dark:text-white">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="ml-4 text-lg leading-2 font-semibold text-gray-900 dark:text-white" style="color: MediumSpringGreen">
                        <label>
                            Categories: {{ $categories->count() ? '' : 'not found'}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @if($categories->count())
            @foreach($categories as $category)
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-2 font-semibold text-gray-900 dark:text-white">{{ $category->name }}</div>
                            </div>

                            <div class="ml-4 text-lg leading-2 font-semibold text-gray-900 dark:text-white">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{ $category->content }}
                                    <div class=" text-lg leading-7 font-semibold"><a href="{{ route('categories.view', $category->id) }}" class="underline text-gray-900 dark:text-white">Read More</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
