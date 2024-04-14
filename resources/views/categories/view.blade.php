@extends('layouts.main')

@section('title', 'Categories View')

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
        <label>
            Blogs:
        </label>
        <form class="job-results-aside-grid" id="filter-form">
            <div class="job-filters-group">
                <div class="job-filters-title">Creation Date</div>
                <div class="date-range-container">
                    <label for="start_date">Start Date:</label>
                    <input
                        type="date" id="start_date" name="start_date" class="form-control">
                    <label for="end_date">End Date:</label>
                    <input
                        type="date" id="end_date" name="end_date" class="form-control">
                </div>
            </div>

            <div class="job-filters-group">
                <div class="job-filters-title">Sort</div>
                <div class="date-range-container">
                    <select id="order" name="order" class="form-control">
                        <option value="new">New</option>
                        <option value="old">Old</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" onclick="load('{{ route('categories.search') }}', 'form:#filter-form', 'category={{ $id }}'); return false;">Apply Filters</button>
        </form>

        <a type="submit" class="btn btn-primary" href="{{ route('categories.view', $id) }}">Reset Filters</a>

        <div class="blog-results-grid" data-aos="fade-left" id="search_results">
            @include('categories._parts._search')
        </div>
    </div>
</div>
@endsection
