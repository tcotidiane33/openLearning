<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Forum
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('forum.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Create New Thread
                    </a>

                    @foreach ($threads as $thread)
                        <div class="mb-4 p-4 border rounded">
                            <h3 class="font-semibold text-lg">
                                <a href="{{ route('forum.show', $thread) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $thread->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600">
                                Started by {{ $thread->user->name }} | {{ $thread->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @endforeach

                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
