<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="mt-16 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-purple-800">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($notifications->count() > 0)
                        <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="mb-4">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mark All as Read
                            </button>
                        </form>

                        @foreach($notifications as $notification)
                            <div class="mb-4 p-4 {{ $notification->read_at ? 'bg-gray-100' : 'bg-blue-100' }} rounded">
                                <p class="font-semibold">{{ $notification->data['message'] }}</p>
                                <p class="text-sm text-gray-600">{{ $notification->created_at->diffForHumans() }}</p>
                                @if(!$notification->read_at)
                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-800">
                                            Mark as Read
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach

                        {{ $notifications->links() }}
                    @else
                        <p>No notifications.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
