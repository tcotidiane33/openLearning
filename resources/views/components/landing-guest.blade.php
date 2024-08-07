<main class="min-h-screen flex items-center justify-center py-28 bg-gray-900 text-white">
    <div class="container flex flex-col items-center text-center">
        <h1 class="lg:text-7xl md:text-5xl text-4xl font-black mb-6">Apprenez. Évoluez. <span class="text-purple-500">Excellez.</span></h1>
        <p class="md:text-xl text-lg mb-12 max-w-3xl text-gray-300">
            Découvrez une plateforme d'apprentissage en ligne de pointe offrant des cours de qualité sur les technologies les plus demandées. Avec Kondronetworks, transformez votre carrière et atteignez de nouveaux sommets.
        </p>
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            @forelse ([...$levels, ...$courses] as $row)
                <span class="md:text-lg py-2 px-4 rounded-full bg-gray-800 text-purple-300 border border-purple-500">
                    {{ $row->level ? $row->level : $row->subject }}
                </span>
            @empty
                <p>Aucun contenu disponible pour le moment</p>
            @endforelse
        </div>
        <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold md:text-xl text-lg py-4 px-8 rounded-full transition duration-300">
            Commencer Maintenant
        </a>
    </div>

    <div class="bg-gray-100 min-h-screen">
        <main class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold mb-8 text-center">Bienvenue sur Kondronetworks</h1>

            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4">Cours en vedette</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($featuredCourses as $course)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">En savoir plus</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-semibold mb-4">Catégories de cours</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.show', $category) }}" class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition duration-300">
                            <h3 class="font-semibold text-lg mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $category->courses_count }} cours</p>
                        </a>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</main>
