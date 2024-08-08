<main class="min-h-screen flex items-center justify-center py-28 bg-gray-900 text-white">
    @props(['featuredCourses' => [], 'categories' => []])
    <div class="bg-purple-900 min-h-screen text-white">
        <main class="container mx-auto px-4 py-16">
            <h1 class="text-6xl font-bold mb-8">Formation à un Coût Pratique</h1>

            <p class="text-xl mb-12 max-w-2xl">
                Découvrez une plateforme de formation à la demande qui met l'apprentissage pratique au premier plan -
                quel que soit votre niveau. Apprenez des meilleurs instructeurs, plongez dans des labs immersifs, et
                prouvez vos connaissances en Réseaux, Cybersécurité, et Cloud.
            </p>

            <div class="flex space-x-4 mb-16">
                <a href="#"
                    class="bg-white text-purple-900 px-8 py-3 rounded-full font-bold text-lg hover:bg-gray-200 transition duration-300">Commencer
                    la Formation</a>
                <a href="#"
                    class="bg-purple-700 text-white px-8 py-3 rounded-full font-bold text-lg hover:bg-purple-600 transition duration-300">Formation
                    pour Équipes</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-semibold mb-6">Cours en Vedette</h2>
                    <div class="space-y-6">
                        @foreach ($featuredCourses as $course)
                            <div class="bg-purple-800 rounded-lg p-6">
                                <h3 class="font-bold text-xl mb-2">{{ $course->title }}</h3>
                                <p class="text-purple-200 mb-4">{{ Str::limit($course->description, 100) }}</p>
                                <a href="#" class="text-white hover:text-purple-200 font-semibold">En savoir plus
                                    →</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-semibold mb-6">Catégories de Cours</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($categories as $category)
                            <a href="#"
                                class="bg-purple-800 rounded-lg p-4 hover:bg-purple-700 transition duration-300">
                                <h3 class="font-semibold text-lg mb-1">{{ $category->name }}</h3>
                                <p class="text-purple-200">{{ $category->courses_count }} cours</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>

        <!-- Alerte promotionnelle -->
        <div class="fixed bottom-0 left-0 right-0 bg-pink-600 text-white py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex-1">
                    <h3 class="text-2xl font-bold">ÉCONOMISEZ & CERTIFIEZ-VOUS</h3>
                    <p>100€ de réduction sur les Certifications de Sécurité INE & les Forfaits Cert + Formation</p>
                </div>
                <a href="#"
                    class="bg-white text-pink-600 px-6 py-2 rounded-full font-bold hover:bg-gray-200 transition duration-300">
                    Profitez de l'Offre
                </a>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-4 py-8">
        <div class="bg-gray-100 min-h-screen">
            <div class="container flex flex-col items-center text-center">
                <h1 class="lg:text-7xl md:text-5xl text-4xl font-black mb-6">Apprenez. Évoluez. <span
                        class="text-purple-500">Excellez.</span></h1>
                <p class="md:text-xl text-lg mb-12 max-w-3xl text-gray-300">
                    Découvrez une plateforme d'apprentissage en ligne de pointe offrant des cours de qualité sur les
                    technologies les plus demandées. Avec Kondronetworks, transformez votre carrière et atteignez de
                    nouveaux
                    sommets.
                </p>
                <div class="flex flex-wrap justify-center gap-4 mb-12">
                    @forelse ([...$levels, ...$courses] as $row)
                        <span
                            class="md:text-lg py-2 px-4 rounded-full bg-gray-800 text-purple-300 border border-purple-500">
                            {{ $row->level ? $row->level : $row->subject }}
                        </span>
                    @empty
                        <p>Aucun contenu disponible pour le moment</p>
                    @endforelse
                </div>
                <a href="{{ route('login') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold md:text-xl text-lg py-4 px-8 rounded-full transition duration-300">
                    Commencer Maintenant
                </a>
            </div>

            <h1 class="text-4xl font-bold mb-8 text-center">Bienvenue sur Kondronetworks</h1>

            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4">Cours en vedette</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach ($featuredCourses as $course)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">En
                                    savoir plus</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>


        </div>
    </main>
</main>
