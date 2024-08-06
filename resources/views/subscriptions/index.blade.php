<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscriptions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->subscription('default'))
                        <h3 class="font-semibold text-lg mb-4">Current Subscription</h3>
                        <p>Plan: {{ auth()->user()->subscription('default')->name }}</p>
                        <p>Status: {{ auth()->user()->subscription('default')->stripe_status }}</p>

                        @if(auth()->user()->subscription('default')->onGracePeriod())
                            <form action="{{ route('subscriptions.resume') }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Resume Subscription
                                </button>
                            </form>
                        @else
                            <form action="{{ route('subscriptions.cancel') }}" method="POST" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Cancel Subscription
                                </button>
                            </form>
                        @endif
                    @else
                        <h3 class="font-semibold text-lg mb-4">Available Plans</h3>
                        @foreach($plans as $plan)
                            <div class="mb-4 p-4 border rounded">
                                <h4 class="font-semibold">{{ $plan->name }}</h4>
                                <p>{{ $plan->description }}</p>
                                <p class="font-bold">{{ $plan->price }} / {{ $plan->interval }}</p>
                                <form action="{{ route('subscriptions.subscribe') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="plan" value="{{ $plan->id }}">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Subscribe
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
