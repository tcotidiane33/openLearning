<x-ap-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instructor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded">
                            <h4 class="font-semibold">Total Students</h4>
                            <p class="text-2xl">{{ $totalStudents }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded">
                            <h4 class="font-semibold">Total Courses</h4>
                            <p class="text-2xl">{{ $instructedCourses->total() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded">
                            <h4 class="font-semibold">Total Revenue</h4>
                            <p class="text-2xl">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Your Courses</h3>
                    <div class="space-y-4">
                        @foreach($instructedCourses as $course)
                            <div class="border p-4 rounded">
                                <h4 class="font-semibold">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                                <div class="mt-2">
                                    <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline">View Course</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $instructedCourses->links() }}
                    </div>

                    <h3 class="text-lg font-semibold mt-8 mb-4">Enrolled Courses</h3>
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
                </div>
            </div>
        </div>
    </div>
</x-main-layout>