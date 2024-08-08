<!-- resources/views/components/accordion-menu.blade.php -->
<div x-data="{ open: false }">
    <button @click="open = !open" class="w-full text-left py-2 px-4 bg-gray-800 text-white">
        Menu <i :class="{'fa-chevron-down': !open, 'fa-chevron-up': open}" class="fas"></i>
    </button>
    <div x-show="open" class="pl-4">
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100">Link 1</a>
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100">Link 2</a>
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-100">Link 3</a>
    </div>
</div>
