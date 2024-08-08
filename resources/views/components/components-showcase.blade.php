<x-main-layout title="Components Showcase">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Components Showcase</h1>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Application Logo</h2>
            <x-application-logo class="w-20 h-20" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Auth Session Status</h2>
            <x-auth-session-status class="mb-4" :status="session('status')" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Danger Button</h2>
            <x-danger-button>
                Delete Account
            </x-danger-button>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Dropdown</h2>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>Dropdown</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Input Error</h2>
            <x-input-error :messages="['This is an error message']" class="mt-2" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Input Label</h2>
            <x-input-label for="email" :value="__('Email')" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Modal</h2>
            <x-modal name="confirm-user-deletion" :show="false" focusable>
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>
                </div>
            </x-modal>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Nav Link</h2>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Primary Button</h2>
            <x-primary-button>
                Save Changes
            </x-primary-button>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Responsive Nav Link</h2>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Secondary Button</h2>
            <x-secondary-button>
                Cancel
            </x-secondary-button>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Text Input</h2>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')"
                required autofocus autocomplete="username" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Landing Guest</h2>
            <x-landing-guest :featuredCourses="collect([
                (object) ['title' => 'Course 1', 'description' => 'Description 1', 'image_url' => '#'],
                (object) ['title' => 'Course 2', 'description' => 'Description 2', 'image_url' => '#'],
            ])" :categories="collect([
                (object) ['name' => 'Category 1', 'courses_count' => 5],
                (object) ['name' => 'Category 2', 'courses_count' => 3],
            ])" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Landing Student</h2>
            <x-landing-student :enrolledCourses="collect([
                (object) ['title' => 'Enrolled Course 1', 'user_progress' => 50, 'image_url' => '#'],
                (object) ['title' => 'Enrolled Course 2', 'user_progress' => 75, 'image_url' => '#'],
            ])" :recommendedCourses="collect([
                (object) ['title' => 'Recommended Course 1', 'description' => 'Description 1', 'image_url' => '#'],
                (object) ['title' => 'Recommended Course 2', 'description' => 'Description 2', 'image_url' => '#'],
            ])" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Landing Instructor</h2>
            <x-landing-instructor :courses="collect([
                (object) [
                    'title' => 'Instructor Course 1',
                    'students_count' => 10,
                    'average_rating' => 4.5,
                    'image_url' => '#',
                ],
                (object) [
                    'title' => 'Instructor Course 2',
                    'students_count' => 15,
                    'average_rating' => 4.8,
                    'image_url' => '#',
                ],
            ])" />
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Landing Admin</h2>
            <x-landing-admin :courses="collect([
                (object) [
                    'title' => 'Admin Course 1',
                    'instructor' => (object) ['name' => 'Instructor 1'],
                    'students_count' => 20,
                    'price' => 99.99,
                ],
                (object) [
                    'title' => 'Admin Course 2',
                    'instructor' => (object) ['name' => 'Instructor 2'],
                    'students_count' => 25,
                    'price' => 149.99,
                ],
            ])" :users="100" />
        </section>
    </div>
</x-main-layout>
