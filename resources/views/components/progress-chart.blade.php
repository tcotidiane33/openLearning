<!-- resources/views/components/progress-chart.blade.php -->
<div class="relative pt-1">
    <div class="flex mb-2 items-center justify-between">
        <div>
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                Progression
            </span>
        </div>
        <div class="text-right">
            <span class="text-xs font-semibold inline-block text-blue-600">
                {{ $progress }}%
            </span>
        </div>
    </div>
    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
        <div style="width: {{ $progress }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
    </div>
</div>
