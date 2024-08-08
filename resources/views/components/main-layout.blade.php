<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Kondronetworks' }}</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body  class="bg-gray-900 text-white p-2">
    <nav class="fixed top-0 inset-x-0 bg-white py-4 z-50">
        <div class="container m-1 p-1 flex justify-between items-center">
            <a href="/" class="text-lg text-zinc-800 font-black">Kondronetworks<span
                    class="text-2xl text-indigo-600">.</span></a>

            <div class="flex gap-6 items-center">
                @if (auth()->check())
                    {{-- <a class="text-zinc-600 hover:text-zinc-800 font-medium" href="#">Mata Pelajaran</a>
                    <a class="text-zinc-600 hover:text-zinc-800 font-medium" href="#">Jenjang</a> --}}
                    <a href="{{ url('/home') }}" class="text-zinc-500 hover:text-purple-900 font-medium">Accueil</a>
                <a href="{{ url('/courses') }}" class="text-zinc-500 hover:text-purple-900 font-medium">Cours</a>
                <a href="{{ url('/certificates') }}" class="text-zinc-500 hover:text-purple-900">Certifications</a>
                <a href="{{ url('/about') }}" class="text-zinc-500 hover:text-purple-900">À propos</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="py-2 font-bold px-6 rounded bg-red-600 text-white">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>
    {{ $slot }}
    <footer class="py-4 border-t">
        <div class="container">
            <p>&copy; Kondronetworks 2023</p>
        </div>
    </footer>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{ $js ?? '' }}
</body>

</html>
