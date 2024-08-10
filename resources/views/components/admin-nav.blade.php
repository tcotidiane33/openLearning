<nav class="bg-blue-800 mt-9">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    {{-- <img class="h-8 w-8" src="{{ asset('images/logo.png') }}" alt="Logo"> --}}
                    <p class='font-bold px-6 rounded ml-2 text-2xl  text-white'>Dashboard<span
                        class="text-2xl text-indigo-500">Kondronetworks</span> </p>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Users</a>
                        <a href="{{ route('admin.courses.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Courses</a>
                        <a href="{{ route('admin.categories.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                        <a href="{{ route('admin.reports.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Reports</a>
                        <a href="{{ route('admin.roles.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roles & Permissions</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button type="button" class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="">
                            </button>
                        </div>
                        <!-- Dropdown menu, show/hide based on menu state. -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>