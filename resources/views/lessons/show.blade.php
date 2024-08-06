<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $lesson->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        {!! $lesson->content !!}
                    </div>

                    @if ($lesson->quiz)
                        <div class="mt-6">
                            <h3 class="font-semibold text-lg mb-2">Quiz</h3>
                            <a href="{{ route('quizzes.show', $lesson->quiz) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Take Quiz
                            </a>
                        </div>
                    @endif

                    <div class="mt-6 flex justify-between">
                        @if ($previousLesson)
                            <a href="{{ route('lessons.show', $previousLesson) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Previous Lesson
                            </a>
                        @endif

                        @if ($nextLesson)
                            <a href="{{ route('lessons.show', $nextLesson) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Next Lesson
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
