<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Course Revenue') }} - {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-2">Total Revenue: ${{ number_format($revenue, 2) }}</h3>

                    <canvas id="revenueChart"></canvas>

                    <!-- Add JavaScript for chart (using Chart.js or similar library) -->
                    @push('scripts')
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const ctx = document.getElementById('revenueChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
                                    datasets: [{
                                        label: 'Monthly Revenue',
                                        data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgb(75, 192, 192)',
                                        borderWidth: 1
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
