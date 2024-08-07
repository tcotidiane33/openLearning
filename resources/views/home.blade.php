<x-main-layout title="Kondronetworks - Platform E-Learning Formation">
    @auth
        @if(auth()->user()->hasRole('student'))
            <x-landing-student :enrolledCourses="$enrolledCourses" :recommendedCourses="$recommendedCourses" />
        @elseif(auth()->user()->hasRole('instructor'))
            <x-landing-instructor :courses="$courses" />
        @elseif(auth()->user()->hasRole('admin'))
            <x-landing-admin :courses="$courses" :users="$users" />
        @endif
    @else
        <x-landing-guest :featuredCourses="$featuredCourses" :categories="$categories" />
    @endauth
</x-main-layout>
{{-- <x-main-layout title="Kondronetworks - Platform E-Learning Formation">
    @if (auth()->check())
        @role('user')
            <x-landing-user />
        @else
            <x-landing-admin />
        @endrole
    @else
        <x-landing-guest />
    @endif
</x-main-layout> --}}
