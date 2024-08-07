<div class="bg-gray-100 min-h-screen">
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Tableau de bord de l'instructeur</h1>

        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Mes cours</h2>
            <a href="{{ route('courses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Créer un nouveau cours</a>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-2">Étudiants inscrits : {{ $course->students_count }}</p>
                            <p class="text-gray-600 text-sm mb-4">Note moyenne : {{ number_format($course->average_rating, 1) }}/5</p>
                            <a href="{{ route('courses.edit', $course) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mr-2">Modifier</a>
                            <a href="{{ route('courses.show', $course) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Voir</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</div>
