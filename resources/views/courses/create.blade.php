<x-main-layout title="Kondronetworks - Ajouter un cours">
    <main class="pt-28 justify-center pb-10 container">
        <div class="max-w-3xl mx-auto p-5 bg-purple-800">
            <div class="flex justify-between items-center gap-2">
                <h1 class="text-2xl font-black mt-2 mb-4">Ajouter un cours</h1>
                <a href="{{ route('courses.index') }}"
                    class="py-2 font-bold px-6 rounded bg-zinc-100 text-zinc-600 text-sm">Retour</a>
            </div>
            <form action="{{ route('courses.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid gap-1">
                    <label for="title" class="font-medium text-zinc-800">Titre</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="py-2 px-4 rounded border focus:outline-none">
                    @error('title')
                        <span class="text-red-600 text-sm font-medium">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="grid gap-1">
                        <label for="level" class="font-medium text-zinc-800">Niveau</label>
                        <input type="text" name="level" id="level" value="{{ old('level') }}"
                            class="py-2 px-4 rounded border focus:outline-none">
                        @error('level')
                            <span class="text-red-600 text-sm font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid gap-1">
                        <label for="subject" class="font-medium text-zinc-800">Sujet</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                            class="py-2 px-4 rounded border focus:outline-none">
                        @error('subject')
                            <span class="text-red-600 text-sm font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-1">
                    <label for="description" class="font-medium text-zinc-800">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="py-2 px-4 rounded border focus:outline-none">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-600 text-sm font-medium">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grid gap-1">
                    <label for="price" class="font-medium text-zinc-800">Prix</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                        class="py-2 px-4 rounded border focus:outline-none">
                    @error('price')
                        <span class="text-red-600 text-sm font-medium">{{ $message }}</span>
                    @enderror
                </div>
                <div class="space-y-1">
                    <label for="content" class="font-medium text-zinc-800">Contenu</label>
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-red-600 text-sm font-medium">{{ $message }}</span>
                    @enderror
                </div>
                <button
                    class="py-2 font-bold px-6 rounded bg-indigo-100 text-indigo-600 text-sm">Soumettre</button>
            </form>
        </div>
    </main>
    <x-slot:js>
        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    licenseKey: '',
                })
                .then(editor => {
                    window.editor = editor;
                })
                .catch(error => {
                    console.error('Oops, something went wrong!');
                    console.error(
                        'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                    );
                    console.warn('Build id: l4dyuz3v73cu-g0a98aaq8txd');
                    console.error(error);
                });
        </script>
    </x-slot:js>
</x-main-layout>
