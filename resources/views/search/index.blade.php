<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('search') }}" method="GET" class="mb-6">
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search courses..." class="w-full px-4 py-2 rounded border">
                        <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Search
                        </button>
                    </form>

                    @if($courses->count() > 0)
                        @foreach($courses as $course)
                            <div class="mb-4 p-4 border rounded">
                                <h3 class="font-semibold text-lg">
                                    <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $course->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600">{{ Str::limit($course->description, 150) }}</p>
                            </div>
                        @endforeach

                        {{ $courses->links() }}
                    @else
                        <p>No courses found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
