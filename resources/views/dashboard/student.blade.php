<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Enrolled Courses</h3>
                    <div class="space-y-4">
                        @foreach($enrolledCourses as $course)
                            <div class="border p-4 rounded">
                                <h4 class="font-semibold">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                                <div class="mt-2">
                                    <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline">Continue Learning</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $enrolledCourses->links() }}
                    </div>

                    <h3 class="text-lg font-semibold mt-8 mb-4">Completed Courses</h3>
                    <div class="space-y-4">
                        @foreach($completedCourses as $course)
                            <div class="border p-4 rounded bg-green-50">
                                <h4 class="font-semibold">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                                <div class="mt-2">
                                    <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline">Review Course</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $completedCourses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>