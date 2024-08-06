<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quiz: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('quizzes.submit', $quiz) }}" method="POST">
                        @csrf
                        @foreach ($quiz->questions as $question)
                            <div class="mb-6">
                                <h3 class="font-semibold text-lg mb-2">{{ $question->content }}</h3>
                                @foreach ($question->answers as $answer)
                                    <div class="mb-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                                            <span class="ml-2">{{ $answer->content }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit Quiz
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
