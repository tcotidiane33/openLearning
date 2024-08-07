<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('courses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Create New Course
                    </a>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($courses as $course)
                            <div class="border p-4 rounded">
                                <h3 class="font-semibold">{{ $course->title }}</h3>
                                <p>{{ Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline">View Course</a>
                            </div>
                        @endforeach
                    </div>
                    
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-main-layout>