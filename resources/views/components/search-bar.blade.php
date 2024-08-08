<!-- resources/views/components/search-bar.blade.php -->
<form action="{{ route('search') }}" method="GET" class="relative">
    <input type="text" name="query" placeholder="Rechercher..." class="border border-gray-300 rounded-full py-2 px-4 w-full">
    <button type="submit" class="absolute right-0 top-0 mt-2 mr-4">
        <i class="fas fa-search"></i>
    </button>
</form>