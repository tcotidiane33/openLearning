<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-2">Enrolled Courses:</h3>
                    @foreach ($enrolledCourses as $course)
                        <div class="mb-2">
                            <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $course->title }}
                            </a>
                        </div>
                    @endforeach

                    <h3 class="font-semibold text-lg mt-4 mb-2">Completed Courses:</h3>
                    @foreach ($completedCourses as $course)
                        <div class="mb-2">
                            <span class="text-green-600">✓</span>
                            <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $course->title }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
