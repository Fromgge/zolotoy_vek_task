<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <div class="flex items-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <div class="ml-4 text-lg leading-7 font-semibold">{{ $blog->title }}</div> <div class="ml-4  leading-7 font-semibold">{{ $blog->created_at->format('Y-m-d') }}</div>
            </div>
            <div class="flex items-center">

            </div>


            <div class="ml-12">
                <div class=" text-lg leading-7 font-semibold"><a href="{{ route('blogs.view', $blog->id) }}" class="underline text-gray-900 dark:text-white">Read More</a></div>

            </div>
        </div>
    </div>
</div>
