<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports & Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Total Revenue</h3>
                            <p class="text-3xl font-bold">${{ number_format($totalRevenue, 2) }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Total Courses</h3>
                            <p class="text-3xl font-bold">{{ $totalCourses }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Revenue by Month</h3>
                        <canvas id="revenueChart"></canvas>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4">Top 5 Courses</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrollments</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($topCourses as $course)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $course->enrollments_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($revenueByMonth->pluck('month')->reverse()) !!},
                datasets: [{
                    label: 'Revenue',
                    data: {!! json_encode($revenueByMonth->pluck('revenue')->reverse()) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endpush
</x-main-layout>