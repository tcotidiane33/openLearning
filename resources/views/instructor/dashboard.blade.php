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
                            <h3 class="font-semibold">Total Students</h3>
                            <p class="text-2xl">{{ $totalStudents }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded">
                            <h3 class="font-semibold">Total Courses</h3>
                            <p class="text-2xl">{{ $user->instructedCourses()->count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded">
                            <h3 class="font-semibold">Total Revenue</h3>
                            <p class="text-2xl">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>

                    <h3 class="font-semibold text-lg mb-2">Recent Enrollments</h3>
                    <!-- Add a list or table of recent enrollments -->
                    <div class="mt-4">
                        <h4 class="text-lg font-semibold mb-2">Recent Enrollments</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Student
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Course
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Enrollment Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentEnrollments as $course)
                                        @foreach($course->recentEnrollments as $enrollment)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $enrollment->user->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $course->title }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $enrollment->created_at->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
