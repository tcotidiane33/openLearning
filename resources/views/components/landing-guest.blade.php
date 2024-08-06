<main class="min-h-screen flex items-center justify-center py-28">
    <div class="container flex flex-col items-center text-center">
        <h1 class="lg:text-8xl md:text-6xl text-5xl font-black">Bienvenue à <span
                class="text-indigo-600">Kondronetworks</span>!</h1>
        <p class="md:text-xl text-lg my-8 max-w-2xl">
            Une plateforme d'apprentissage en ligne qui vous permet d'explorer et d'apprendre
            une variété de modules d’apprentissage soigneusement sélectionnés. Avec accès à des milliers de modules d'apprentissage,
            Learniverse propose une variété de cours sur différentes matières et niveaux d'enseignement.
        </p>
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            @forelse ([...$levels, ...$courses] as $row)
                <span
                    class="md:text-lg py-2 px-4 rounded-full border text-zinc-800">{{ $row->level ? $row->level : $row->subject }}</span>
            @empty
                <p>Vide</p>
            @endforelse
        </div>
        <a href="{{ route('login') }}"
            class="bg-indigo-600 text-white font-bold md:text-xl text-lg py-4 px-8 rounded">Commencer
            Maintenant!</a>
    </div>
</main>
