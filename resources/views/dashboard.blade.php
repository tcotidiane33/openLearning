<x-main-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-purple-700 to-indigo-600 py-12">
            <h2 class="text-3xl font-bold text-white text-center leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>
    <x-landing-guest :featuredCourses="$featuredCourses" :categories="$categories" :courses="$courses" />


</x-main-layout>
