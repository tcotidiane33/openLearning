<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instructor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded">
                            <h3 class="font-semibold text-lg">Total Students</h3>
                            <p class="text-3xl font-bold">{{ $totalStudents }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded">
                            <h3 class="font-semibold text-lg">Total Courses</h3>
                            <p class="text-3xl font-bold">{{ $user->instructedCourses->count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded">
                            <h3 class="font-semibold text-lg">Total Revenue</h3>
                            <p class="text-3xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>

                    <h3 class="font-semibold text-lg mb-2">Course Enrollments</h3>
                    <table class="w-full mb-6">
                        <thead>
                            <tr>
                                <th class="text-left">Course</th>
                                <th class="text-left">Enrollments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courseEnrollments as $course)
                                <tr>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->students_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="font-semibold text-lg mb-2">Recent Reviews</h3>
                    @foreach($recentReviews as $review)
                        <div class="mb-4 p-4 border rounded">
                            <p class="font-semibold">{{ $review->course->title }}</p>
                            <p>Rating: {{ $review->rating }}/5</p>
                            <p>{{ $review->comment }}</p>
                            <p class="text-sm text-gray-600">By {{ $review->user->name }} on {{ $review->created_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
