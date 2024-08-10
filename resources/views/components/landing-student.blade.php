<div class=" bg-blue-900 min-h-screen ">
    <main class="container mx-auto px-4 py-8 mt-16">
        @php
            $tabs = [
                ['id' => 'student', 'label' => 'student Courses', 'url' => '/student/coourses'],
                ['id' => 'student', 'label' => 'student Progress', 'url' => '/student/progress'],
                ['id' => 'student', 'label' => 'student Certificates', 'url' => '/student/certificates'],
            ];
        @endphp

        <x-tab-navigation :tabs="$tabs" :activeTab="'student'" />

        @if ($latestAnnouncement)
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-8" role="alert">
                <p class="font-bold">Annonce</p>
                <p>{{ $latestAnnouncement->content }}</p>
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-8">Tableau de bord de l'étudiant <span
                class="text-purple-200 p-1 badge rounded-2 text-bold text-lg">Bienvenue,
                {{ auth()->user()->name }}!</span>
        </h1>
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">Mes cours inscrits</h2>
            @if ($enrolledCourses->isEmpty())
                <p class="text-purple-200 badge p-1">Vous n'êtes inscrit à aucun cours pour le moment.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($enrolledCourses as $course)
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                                <div class="mb-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blue-600 h-2.5 rounded-full"
                                            style="width: {{ $course->user_progress }}%"></div>
                                    </div>
                                    <p class="text-gray-600 text-sm mt-1">Progression : {{ $course->user_progress }}%
                                    </p>
                                </div>
                                <a href="{{ route('courses.show', $course) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                                    Continuer
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <section>
            <h2 class="text-2xl font-semibold mb-4">Cours recommandés</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($recommendedCourses as $course)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">{{ number_format($course->price, 2) }} €</span>
                                <a href="{{ route('courses.show', $course) }}"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
                                    En savoir plus
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mt-12">
            <h2 class="text-2xl font-semibold mb-4">Mes progrès</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-4">
                    <h3 class="font-semibold text-lg mb-2">Cours complétés</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $completedCoursesCount }} /
                        {{ $enrolledCourses->count() }}</p>
                </div>
                <div class="mb-4">
                    <h3 class="font-semibold text-lg mb-2">Temps total d'apprentissage</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalLearningTime }} heures</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-2">Certificats obtenus</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $certificatesCount }}</p>
                </div>
            </div>
        </section>
    </main>
</div>
