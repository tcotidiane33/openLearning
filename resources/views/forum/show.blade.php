<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $thread->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">{{ $thread->title }}</h3>
                        <p class="text-gray-600">Posted by {{ $thread->user->name }} on {{ $thread->created_at->format('M d, Y H:i') }}</p>
                        <div class="mt-4">
                            {{ $thread->content }}
                        </div>
                    </div>

                    <h4 class="text-lg font-semibold mb-4">Replies</h4>

                    @forelse ($thread->posts as $post)
                        <div class="mb-4 p-4 border rounded">
                            <p>{{ $post->content }}</p>
                            <p class="text-sm text-gray-600 mt-2">
                                Replied by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y H:i') }}
                            </p>
                        </div>
                    @empty
                        <p>No replies yet.</p>
                    @endforelse

                    <form action="{{ route('forum.storePost', [$thread->course, $thread]) }}" method="POST" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Your Reply</label>
                            <textarea name="content" id="content" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Post Reply
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
