<div class="bg-gray-900 text-white min-h-screen">
    <main class="pt-28 pb-10">
        <div class="container mx-auto px-4">
            <span class="text-gray-400">Bienvenue, {{ auth()->user()->name }}!</span>
            
            <div class="py-28 mb-8">
                <h1 class="text-3xl font-black">Gestion des modules</h1>
                <a href="{{ route('courses.create') }}" class="py-2 px-6 rounded-full bg-purple-600 hover:bg-purple-700 text-white font-bold transition duration-300">
                    Créer un module
                </a>
            </div>

            @if (session()->has('success'))
                <div class="py-2 px-4 rounded bg-green-800 text-green-200 mb-6 border border-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="w-full overflow-x-auto bg-gray-800 rounded-xl mb-12">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-sm font-medium text-gray-400 border-b border-gray-700 py-4 px-6 text-left">No</th>
                            <th class="text-sm font-medium text-gray-400 text-left border-b border-gray-700 py-4 px-6">Créé le</th>
                            <th class="text-sm font-medium text-gray-400 text-left border-b border-gray-700 py-4 px-6">Sujet</th>
                            <th class="text-sm font-medium text-gray-400 text-left border-b border-gray-700 py-4 px-6">Titre</th>
                            <th class="text-sm font-medium text-gray-400 text-left border-b border-gray-700 py-4 px-6">Niveau</th>
                            <th class="text-sm font-medium text-gray-400 text-left border-b border-gray-700 py-4 px-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $row)
                            <tr>
                                <td class="text-gray-300 py-4 border-b border-gray-700 px-6">{{ $loop->iteration }}</td>
                                <td class="text-gray-300 py-4 border-b border-gray-700 px-6">
                                    {{ $row->created_at->diffForHumans() }}
                                    <span class="text-xs py-1 px-2 rounded-full bg-gray-700 text-gray-300 ml-2">{{ $row->created_at }}</span>
                                </td>
                                <td class="text-gray-300 py-4 border-b border-gray-700 px-6">{{ $row->subject }}</td>
                                <td class="text-gray-300 py-4 border-b border-gray-700 px-6">{{ $row->title }}</td>
                                <td class="text-gray-300 py-4 border-b border-gray-700 px-6">{{ $row->level }}</td>
                                <td class="text-gray-300 py-4 border-b border-gray-700 px-6">
                                    <div class="flex gap-2">
                                        <a href="{{ route('courses.show', $row->id) }}" class="py-1 px-3 rounded bg-blue-600 hover:bg-blue-700 text-white text-sm transition duration-300">Aperçu</a>
                                        <a href="{{ route('courses.edit', $row->id) }}" class="py-1 px-3 rounded bg-yellow-600 hover:bg-yellow-700 text-white text-sm transition duration-300">Modifier</a>
                                        <form action="{{ route('courses.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                                            @method('DELETE')
                                            @csrf
                                            <button class="py-1 px-3 rounded bg-red-600 hover:bg-red-700 text-white text-sm transition duration-300">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-400">Aucun module disponible</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">Nombre total d'utilisateurs</h2>
                    <p class="text-3xl font-bold text-blue-600">{{ $users }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">Nombre total de cours</h2>
                    <p class="text-3xl font-bold text-green-600">{{ $courses->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">Revenus totaux</h2>
                    <p class="text-3xl font-bold text-purple-600">{{ number_format($courses->sum('price'), 2) }} €</p>
                </div>
            </div>

            <section>
                <h2 class="text-2xl font-semibold mb-4 text-white">Cours récents</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Titre</th>
                                <th class="py-3 px-6 text-left">Instructeur</th>
                                <th class="py-3 px-6 text-center">Étudiants</th>
                                <th class="py-3 px-6 text-center">Prix</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($courses->take(5) as $course)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $course->title }}</td>
                                    <td class="py-3 px-6 text-left">{{ $course->instructor->name }}</td>
                                    <td class="py-3 px-6 text-center">{{ $course->students_count }}</td>
                                    <td class="py-3 px-6 text-center">{{ number_format($course->price, 2) }} €</td>
                                    <td class="py-3 px-6 text-center">
                                        <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-900 mr-2">Voir</a>
                                        <a href="{{ route('courses.edit', $course) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</div>