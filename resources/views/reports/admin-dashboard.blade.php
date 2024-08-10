<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Total Courses</h3>
                        <p class="text-3xl font-bold">{{ $totalCourses }}</p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Total Revenue</h3>
                        <p class="text-3xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
                    </div>
                </div>

                <h3 class="text-lg font-semibold mb-4">Recent Enrollments</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrolled At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentEnrollments as $enrollment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $enrollment->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $enrollment->course->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $enrollment->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main-layout>