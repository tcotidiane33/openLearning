<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Successful') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg mb-4 text-green-600">Payment Successful!</h3>
                    <p>Thank you for your purchase. Your transaction has been completed successfully.</p>
                    <p class="mt-4">Transaction ID: {{ session('transaction_id') }}</p>
                    <a href="{{ route('dashboard') }}" class="mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
