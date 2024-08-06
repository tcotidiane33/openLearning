<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-gray-600 mb-4">{{ $course->description }}</p>

                    <h3 class="font-semibold text-lg mb-2">Lessons:</h3>
                    <ul class="list-disc list-inside">
                        @foreach ($course->lessons as $lesson)
                            <li>
                                <a href="{{ route('lessons.show', $lesson) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $lesson->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    @if (Auth::user()->can('update', $course))
                        <div class="mt-4">
                            <a href="{{ route('courses.edit', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Course
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
