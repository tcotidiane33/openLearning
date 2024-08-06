<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <form action="{{ route('courses.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" placeholder="Search courses..." class="rounded-l-md border-t border-b border-l border-gray-300 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="submit" class="rounded-r-md border-t border-b border-r border-gray-300 px-4 py-2 bg-gray-100 hover:bg-gray-200">Search</button>
                    </form>
                </div>
                @can('create', App\Models\Course::class)
                    <a href="{{ route('courses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Course
                    </a>
                @endcan
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($courses as $course)
                            <div class="border rounded-lg overflow-hidden shadow-lg">
                                <img class="w-full h-48 object-cover" src="{{ $course->image_url ?? asset('images/default-course.jpg') }}" alt="{{ $course->title }}">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $course->title }}</div>
                                    <p class="text-gray-700 text-base">
                                        {{ Str::limit($course->description, 100) }}
                                    </p>
                                </div>
                                <div class="px-6 pt-4 pb-2">
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $course->category->name }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $course->level }}</span>
                                </div>
                                <div class="px-6 py-4">
                                    <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                        View Course
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p>No courses found.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
