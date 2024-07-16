<x-main-layout title="Kondronetworks - Platform E-Learning Formation">
    @if (auth()->check())
        @role('user')
            <x-landing-user />
        @else
            <x-landing-admin />
        @endrole
    @else
        <x-landing-guest />
    @endif
</x-main-layout>
