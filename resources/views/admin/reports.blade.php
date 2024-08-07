<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Add your reports content here -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Overall Statistics</h3>
                            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                                <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Users
                                    </dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                        {{ $totalUsers }}
                                    </dd>
                                </div>
                    
                                <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Courses
                                    </dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                        {{ $totalCourses }}
                                    </dd>
                                </div>
                    
                                <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Revenue
                                    </dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                        ${{ number_format($totalRevenue, 2) }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Monthly Revenue</h3>
                            <div class="mt-5 bg-white shadow rounded-lg p-6">
                                <canvas id="revenueChart"></canvas>
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
                                labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
                                datasets: [{
                                    label: 'Monthly Revenue',
                                    data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
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
                </div>
            </div>
        </div>
    </div>
</x-main-layout>