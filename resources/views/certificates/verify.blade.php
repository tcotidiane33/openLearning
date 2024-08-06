<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verify Certificate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('certificates.verify') }}" method="GET" class="mb-6">
                        <div class="mb-4">
                            <label for="certificate_number" class="block text-gray-700 text-sm font-bold mb-2">
                                Certificate Number
                            </label>
                            <input type="text" name="certificate_number" id="certificate_number" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Verify Certificate
                        </button>
                    </form>

                    @if(isset($certificate))
                        <div class="mt-6 p-4 bg-green-100 rounded">
                            <h3 class="font-semibold text-lg mb-2">Certificate Verified</h3>
                            <p><strong>Certificate Number:</strong> {{ $certificate->certificate_number }}</p>
                            <p><strong>Course:</strong> {{ $certificate->course->title }}</p>
                            <p><strong>Student:</strong> {{ $certificate->user->name }}</p>
                            <p><strong>Issue Date:</strong> {{ $certificate->created_at->format('F d, Y') }}</p>
                        </div>
                    @elseif(isset($error))
                        <div class="mt-6 p-4 bg-red-100 rounded">
                            <p class="text-red-700">{{ $error }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
