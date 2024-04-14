@extends('layouts.main')

@section('title', 'Blogs')

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

    @if($blogs->count())
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 ">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    @foreach($blogs as $blog)
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-2 font-semibold text-gray-900 dark:text-white">{{ $blog->title }}</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{ $blog->content }}
                                    @if ($blog->categories->count())
                                    <p>Categories:
                                        @foreach ($blog->categories as $index => $category)
                                            {{ $category->name }}
                                            @if ($index < $blog->categories->count() - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                    @endif
                                    <div class=" text-lg leading-7 font-semibold"><a href="{{ route('blogs.view', $blog->id) }}" class="underline text-gray-900 dark:text-white">Read More</a></div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
