<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons for') }} {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @can('create', [App\Models\Lesson::class, $course])
                        <div class="mb-6">
                            <a href="{{ route('courses.lessons.create', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add New Lesson
                            </a>
                        </div>
                    @endcan

                    <div class="space-y-4">
                        @forelse ($lessons as $lesson)
                            <div class="flex items-center justify-between p-4 border rounded">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $lesson->title }}</h3>
                                    <p class="text-gray-600">{{ Str::limit($lesson->description, 100) }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('lessons.show', $lesson) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        View
                                    </a>
                                    @can('update', $lesson)
                                        <a href="{{ route('lessons.edit', $lesson) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                            Edit
                                        </a>
                                    @endcan
                                    @can('delete', $lesson)
                                        <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lesson?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <p>No lessons found for this course.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
