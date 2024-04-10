@if($blogs->count())
    @foreach($blogs as $blog)
        @include('categories._parts._blog_card')
    @endforeach
@else
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="ml-4 text-lg leading-2 font-semibold text-gray-900 dark:text-white" style="color: Red">
                    <label>
                        Result not found
                    </label>
                </div>
            </div>
        </div>
    </div>
@endif
