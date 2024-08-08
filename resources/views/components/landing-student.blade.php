<div class="bg-gray-100 min-h-screen">
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Tableau de bord de l'étudiant</h1>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Mes cours inscrits</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($enrolledCourses as $course)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">Progression : {{ $course->user_progress }}%</p>
                            <a href="{{ route('courses.show', $course) ?? '#' }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Continuer
                            </a>
                            {{-- <a href="{{ route('courses.show', $course) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Continuer</a> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section>
            <h2 class="text-2xl font-semibold mb-4">Cours recommandés</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($recommendedCourses as $course)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">En savoir plus</a>
                            <a href="{{ route('courses.show', $course) ?? '#' }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Continuer
                            </a>
                            {{-- <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">En savoir plus</a> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</div>
