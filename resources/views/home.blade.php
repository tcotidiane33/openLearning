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
    {{-- <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold">XLearn</a>
            <div class="space-x-4">
                <a href="{{ url('/home') }}" class="hover:text-purple-400">Accueil</a>
                <a href="{{ url('/courses') }}" class="hover:text-purple-400">Cours</a>
                <a href="{{ url('/certificates') }}" class="hover:text-purple-400">Certifications</a>
                <a href="{{ url('/about') }}" class="hover:text-purple-400">À propos</a>
                <a href="{{ url('/login') }}" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded">Connexion</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-20 text-center">
        <h1 class="text-5xl font-bold mb-4">Apprenez. Évoluez. Excellez.</h1>
        <p class="text-xl mb-8">Découvrez des cours de qualité sur les technologies les plus demandées.</p>
        <a href="#"
            class="bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-full text-lg font-semibold">Commencer
            maintenant</a>
    </header>

    
    <!-- Subscription Plans -->
    <section class="py-20 bg-gray-800">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Choisissez votre plan</h2>
            <div class="flex justify-center space-x-8">
                <!-- Basic Plan -->
                <div class="bg-gray-700 p-8 rounded-lg w-80">
                    <h3 class="text-2xl font-bold mb-4">Basic</h3>
                    <p class="text-3xl font-bold mb-6">$59<span class="text-sm font-normal">/mois</span></p>
                    <ul class="mb-8">
                        <li class="mb-2">✓ Accès à tous les cours</li>
                        <li class="mb-2">✓ Exercices pratiques</li>
                        <li class="mb-2">✓ Support communautaire</li>
                    </ul>
                    <a href="#"
                        class="block text-center bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded">Choisir ce
                        plan</a>
                </div>

                <!-- Premium Plan -->
                <div class="bg-gray-700 p-8 rounded-lg w-80 transform scale-105 shadow-lg">
                    <h3 class="text-2xl font-bold mb-4">Premium</h3>
                    <p class="text-3xl font-bold mb-6">$99<span class="text-sm font-normal">/mois</span></p>
                    <ul class="mb-8">
                        <li class="mb-2">✓ Tout du plan Basic</li>
                        <li class="mb-2">✓ Certifications incluses</li>
                        <li class="mb-2">✓ Projets guidés</li>
                        <li class="mb-2">✓ Support prioritaire</li>
                    </ul>
                    <a href="#"
                        class="block text-center bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded">Choisir ce
                        plan</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Cours populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Course Card -->
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Introduction au Machine Learning</h3>
                        <p class="text-gray-400 mb-4">Apprenez les bases du ML avec Python</p>
                        <a href="#" class="text-purple-400 hover:underline">En savoir plus</a>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Introduction au SD-WAN Learning</h3>
                        <p class="text-gray-400 mb-4">Apprenez les bases du SD-WAN avec @PA</p>
                        <a href="#" class="text-purple-400 hover:underline">En savoir plus</a>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Introduction au LAN</h3>
                        <p class="text-gray-400 mb-4">Apprenez les bases du LAN avec @PL</p>
                        <a href="#" class="text-purple-400 hover:underline">En savoir plus</a>
                    </div>
                </div>
                <!-- Repeat for other courses -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 XLearn. Tous droits réservés.</p>
            <div class="mt-4">
                <a href="#" class="text-gray-400 hover:text-white mx-2">Conditions d'utilisation</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Politique de confidentialité</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Contact</a>
            </div>
        </div>
    </footer> --}}
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

{{-- <x-main-layout title="Kondronetworks - Platform E-Learning Formation">
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
    </x-main-layout> --}}