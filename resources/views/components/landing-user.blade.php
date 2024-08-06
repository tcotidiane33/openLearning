<main class="pt-28 pb-10">
    <div class="container">
        <span class="text-zinc-600">Bienvenue {{ auth()->user()->name }}!</span>
        <h1 class="text-2xl font-black mt-2 mb-4">Des recommandations pour vous!</h1>
        <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-4">
            @forelse ($modules as $row)
                <a href="{{ route('courses.show', $row->id) }}" class="p-6 rounded-xl border">
                    <h2 class="text-xl font-bold mb-1">{{ $row->title }}</h2>
                    <div class="flex items-center justify-between gap-1">
                        <p class="text-sm">Niveau: {{ $row->level }}</p>
                        <span class="text-xs py-1 px-2 rounded-full bg-indigo-600 text-white">{{ $row->subject }}</span>
                    </div>
                </a>
            @empty
                <p>Vide</p>
            @endforelse
        </div>
    </div>
</main>
<section class="py-20">
    <div class="container">
        <h1 class="text-2xl font-black mb-4">Filtrer par niveau / matière:</h1>
        <div class="flex flex-wrap gap-2">
            @forelse ([...$levels, ...$courses] as $row)
                <a href="{{ route($row->level ? 'level' : 'subject', $row->level ? $row->level : $row->subject) }}"
                    class="text-lg py-2 px-4 rounded-full border text-zinc-800">{{ $row->level ? $row->level : $row->subject }}</a>
            @empty
                <p>Vide</p>
            @endforelse
        </div>
    </div>
</section>
