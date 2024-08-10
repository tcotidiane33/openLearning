<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-6">Gestion des Annonces</h2>

    <!-- Formulaire pour créer/éditer une annonce -->
    <form action="{{ isset($editAnnouncement) ? route('announcements.update', $editAnnouncement->id) : route('announcements.store') }}" method="POST" class="mb-8">
        @csrf
        @if(isset($editAnnouncement))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>
            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $editAnnouncement->title ?? old('title') }}" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Contenu</label>
            <textarea name="content" id="content" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $editAnnouncement->content ?? old('content') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="link" class="block text-gray-700 text-sm font-bold mb-2">Lien (optionnel)</label>
            <input type="url" name="link" id="link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $editAnnouncement->link ?? old('link') }}">
        </div>

        <div class="mb-4">
            <label for="expire_at" class="block text-gray-700 text-sm font-bold mb-2">Date d'expiration (optionnel)</label>
            <input type="datetime-local" name="expire_at" id="expire_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ isset($editAnnouncement) && $editAnnouncement->expire_at ? $editAnnouncement->expire_at->format('Y-m-d\TH:i') : old('expire_at') }}">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            {{ isset($editAnnouncement) ? 'Mettre à jour' : 'Créer' }} l'annonce
        </button>
    </form>

    <!-- Liste des annonces existantes -->
    <h3 class="text-xl font-semibold mb-4">Annonces existantes</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Titre</th>
                    <th class="py-2 px-4 border-b">Statut</th>
                    <th class="py-2 px-4 border-b">Date d'expiration</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($announcements as $announcement)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $announcement->title }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($announcement->is_published)
                                <span class="text-green-600">Publiée</span>
                            @else
                                <span class="text-red-600">Non publiée</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ $announcement->expire_at ? $announcement->expire_at->format('d/m/Y H:i') : 'N/A' }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('announcements.edit', $announcement->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Éditer</a>
                            @if(!$announcement->is_published)
                                <form action="{{ route('announcements.publish', $announcement->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 mr-2">Publier</button>
                                </form>
                            @endif
                            <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>