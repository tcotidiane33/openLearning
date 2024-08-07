<main class="pt-28 pb-10 bg-gray-900 text-white">
    <div class="container">
        <span class="text-gray-400">Bienvenue, {{ auth()->user()->name }}!</span>
        <h1 class="text-3xl font-black mt-2 mb-8">Recommandations personnalisées</h1>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-6">
            @forelse ($modules as $row)
                <a href="{{ route('courses.show', $row->id) }}" class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-purple-500 transition duration-300">
                    <h2 class="text-xl font-bold mb-2">{{ $row->title }}</h2>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-sm text-gray-400">Niveau: {{ $row->level }}</p>
                        <span class="text-xs py-1 px-3 rounded-full bg-purple-600 text-white">{{ $row->subject }}</span>
                    </div>
                </a>
            @empty
                <p class="text-gray-400">Aucun module disponible pour le moment</p>
            @endforelse
        </div>
    </div>
</main>
<section class="py-20 bg-gray-800">
    <div class="container">
        <h2 class="text-3xl font-black mb-8 text-white">Explorer par catégorie</h2>
        <div class="flex flex-wrap gap-4">
            @forelse ([...$levels, ...$courses] as $row)
                <a href="{{ route($row->level ? 'level' : 'subject', $row->level ? $row->level : $row->subject) }}"
                   class="text-lg py-2 px-6 rounded-full bg-gray-700 text-purple-300 hover:bg-purple-600 hover:text-white transition duration-300">
                    {{ $row->level ? $row->level : $row->subject }}
                </a>
            @empty
                <p class="text-gray-400">Aucune catégorie disponible</p>
            @endforelse
        </div>
    </div>
</section>
