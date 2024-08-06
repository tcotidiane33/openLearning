<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded">
                            <h3 class="font-semibold text-lg">Total Users</h3>
                            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded">
                            <h3 class="font-semibold text-lg">Total Courses</h3>
                            <p class="text-3xl font-bold">{{ $totalCourses }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded">
                            <h3 class="font-semibold text-lg">Total Revenue</h3>
                            <p class="text-3xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>

                    <h3 class="font-semibold text-lg mb-2">Recent Enrollments</h3>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left">User</th>
                                <th class="text-left">Course</th>
                                <th class="text-left">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentEnrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->user_name }}</td>
                                    <td>{{ $enrollment->course_title }}</td>
                                    <td>{{ $enrollment->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
