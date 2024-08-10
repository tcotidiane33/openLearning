<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.courses.index') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Search courses..." class="border rounded px-2 py-1">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Search</button>
                    </form>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($courses as $course)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $course->title }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $course->instructor->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $course->category->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">${{ $course->price }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $course->is_approved ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $course->is_approved ? 'Approved' : 'Not Approved' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                        <form action="{{ route('admin.courses.toggle-approval', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-{{ $course->is_approved ? 'red' : 'green' }}-600 hover:text-{{ $course->is_approved ? 'red' : 'green' }}-900 mr-2">
                                                {{ $course->is_approved ? 'Unapprove' : 'Approve' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.courses.toggle-featured', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-{{ $course->is_featured ? 'yellow' : 'blue' }}-600 hover:text-{{ $course->is_featured ? 'yellow' : 'blue' }}-900">
                                                {{ $course->is_featured ? 'Unfeature' : 'Feature' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>