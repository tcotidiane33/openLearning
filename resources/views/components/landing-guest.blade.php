<div class="min-h-screen  bg-gray-900 text-white">
    @props(['featuredCourses' => [], 'categories' => [], 'courses' => []])
    <div class="bg-purple-900 min-h-screen text-white">
        <div class="container justify-center   py-28 items-center mx-auto px-4 py-16">
            <h1 class="text-6xl font-bold mb-8">Formation à un Coût Pratique</h1>

            <p class="text-xl mb-12 max-w-2xl">
                Découvrez une plateforme de formation à la demande qui met l'apprentissage pratique au premier plan -
                quel que soit votre niveau. Apprenez des meilleurs instructeurs, plongez dans des labs immersifs, et
                prouvez vos connaissances en Réseaux, Cybersécurité, et Cloud.
            </p>

            <div class="flex space-x-4 mb-16">
                
                <a href="{{ route('register') }}"
                    class="bg-white text-purple-900 px-8 py-3 rounded-full font-bold text-lg hover:bg-gray-200 transition duration-300">Commencer
                    la Formation</a>
                <a href="{{ route('subscriptions.index') }}"
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
        </div>

        <div class="container justify-center   py-28 items-center mx-auto px-4 py-16">
            <div class="bg-gray-800 min-h-screen p-4">
                <div class="container flex flex-col items-center text-center mb-6">
                    <h1 class="lg:text-7xl md:text-5xl text-4xl font-black mb-6">Apprenez. Évoluez. <span
                            class="text-purple-500">Excellez.</span></h1>
                    <p class="md:text-xl text-lg mb-12 max-w-3xl text-gray-300">
                        Découvrez une plateforme d'apprentissage en ligne de pointe offrant des cours de qualité sur les
                        technologies les plus demandées. Avec Kondronetworks, transformez votre carrière et atteignez de
                        nouveaux
                        sommets.
                    </p>
                    <div class=" flex-wrap justify-center gap-4 mb-12">
                        @forelse ($courses as $course)
                            <div>
                                <!-- Affichez le niveau s'il est défini, sinon affichez le sujet -->
                                <span
                                    class="md:text-lg py-2 px-4 rounded-full bg-gray-800 text-purple-300 border border-purple-500">
                                    {{ $course->level ?? $course->subject }}
                                </span>
                            </div>
                        @empty
                            <div>
                                Aucun contenu disponible pour le moment
                            </div>
                        @endforelse


                    </div>
                    <a href="{{ route('login') }}"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold md:text-xl text-lg py-4 px-8 rounded-full transition duration-300">
                        Commencer Maintenant
                    </a>
                </div>
                <div classe="flex flex-wrap justify-center gap-4 mt-7 mb-8 ">
                    <div class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
                        <div class="max-w-7xl mx-auto">
                            <h1 class="text-4xl font-bold text-center text-gray-900 mb-12">Choisissez votre plan d'apprentissage</h1>
                            
                            <div class="grid md:grid-cols-3 gap-8">
                                <!-- Plan Débutant -->
                                <div class="bg-white text-purple-700 rounded-lg shadow-lg overflow-hidden">
                                    <div class="px-6 py-8">
                                        <h2 class="text-2xl font-semibold text-center mb-4">Débutant</h2>
                                        <p class="text-gray-600 text-center mb-6">Parfait pour commencer votre voyage d'apprentissage</p>
                                        <div class="text-center">
                                            <span class="text-4xl font-bold">19,99€</span>
                                            <span class="text-gray-600">/mois</span>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-200 px-6 py-4">
                                        <ul class="text-sm text-gray-600">
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Accès à 50+ cours débutants
                                            </li>
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Support communautaire
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Certificats de réussite
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="px-6 py-4">
                                        <button class="w-full bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-200">Commencer</button>
                                    </div>
                                </div>
                
                                <!-- Plan Intermédiaire -->
                                <div class="bg-white text-purple-700 rounded-lg shadow-lg overflow-hidden border-4 border-blue-500">
                                    <div class="px-6 py-8">
                                        <h2 class="text-2xl font-semibold text-center mb-4">Intermédiaire</h2>
                                        <p class="text-gray-600 text-center mb-6">Pour ceux qui veulent aller plus loin</p>
                                        <div class="text-center">
                                            <span class="text-4xl font-bold">39,99€</span>
                                            <span class="text-gray-600">/mois</span>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-200 px-6 py-4">
                                        <ul class="text-sm text-gray-600">
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Accès à 150+ cours
                                            </li>
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Projets pratiques
                                            </li>
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Support prioritaire
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Accès aux webinaires mensuels
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="px-6 py-4">
                                        <button class="w-full bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-200">Choisir ce plan</button>
                                    </div>
                                </div>
                
                                <!-- Plan Expert -->
                                <div class="bg-white text-purple-700 rounded-lg shadow-lg overflow-hidden">
                                    <div class="px-6 py-8">
                                        <h2 class="text-2xl font-semibold text-center mb-4">Expert</h2>
                                        <p class="text-gray-600 text-center mb-6">Pour les professionnels et les passionnés</p>
                                        <div class="text-center">
                                            <span class="text-4xl font-bold">79,99€</span>
                                            <span class="text-gray-600">/mois</span>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-200 px-6 py-4">
                                        <ul class="text-sm text-gray-600">
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Accès illimité à tous les cours
                                            </li>
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Mentorat personnalisé
                                            </li>
                                            <li class="mb-2 flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Accès aux conférences exclusives
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Certification avancée
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="px-6 py-4">
                                        <button class="w-full bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-200">Devenir expert</button>
                                    </div>
                                </div>
                            </div>
                
                            <div class="mt-12 text-center">
                                <p class="text-gray-600">Besoin d'une solution pour votre entreprise ?</p>
                                <a href="#" class="text-blue-500 font-semibold hover:underline">Contactez-nous pour un plan personnalisé</a>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="text-4xl font-bold mt-7 mb-8 text-center">Bienvenue sur Kondronetworks</h1>

                <section class="mb-12">
                    <h2 class="text-2xl font-semibold mb-4">Cours en vedette</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        @foreach ($featuredCourses as $course)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                                    class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}
                                    </p>
                                    <a href="#"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">En
                                        savoir plus</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>


            </div>
        </div>

        <!-- Alerte promotionnelle -->
        @php
            $latestAnnouncement = \App\Models\Announcement::where('is_published', true)
                ->where('publish_at', '<=', now())
                ->where(function ($query) {
                    $query->where('expire_at', '>', now())->orWhereNull('expire_at');
                })
                ->latest()
                ->first();
        @endphp

        @if ($latestAnnouncement)
            <div class="fixed bottom-0 left-0 right-0 bg-pink-600 text-white py-4">
                <div class="container mx-auto px-4 flex justify-between items-center">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold">{{ $latestAnnouncement->title }}</h3>
                        <p>{{ $latestAnnouncement->content }}</p>
                    </div>
                    @if ($latestAnnouncement->link)
                        <a href="{{ $latestAnnouncement->link }}"
                            class="bg-white text-pink-600 px-6 py-2 rounded-full font-bold hover:bg-gray-200 transition duration-300">
                            Profitez de l'Offre
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
