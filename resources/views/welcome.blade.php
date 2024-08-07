<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>XLearn - Plateforme d'apprentissage en ligne</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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

<body class="bg-gray-900 text-white">
    {{-- @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif --}}
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">XLearn</a>
            <div class="space-x-4">
                <a href="#" class="hover:text-purple-400">Accueil</a>
                <a href="#" class="hover:text-purple-400">Cours</a>
                <a href="#" class="hover:text-purple-400">Certifications</a>
                <a href="#" class="hover:text-purple-400">À propos</a>
                <a href="#" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded">Connexion</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-20 text-center">
        <h1 class="text-5xl font-bold mb-4">Apprenez. Évoluez. Excellez.</h1>
        <p class="text-xl mb-8">Découvrez des cours de qualité sur les technologies les plus demandées.</p>
        <a href="#"
            class="bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-full text-lg font-semibold">Commencer
            maintenant</a>
    </header>

    <!-- Subscription Plans -->
    <section class="py-20 bg-gray-800">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Choisissez votre plan</h2>
            <div class="flex justify-center space-x-8">
                <!-- Basic Plan -->
                <div class="bg-gray-700 p-8 rounded-lg w-80">
                    <h3 class="text-2xl font-bold mb-4">Basic</h3>
                    <p class="text-3xl font-bold mb-6">$59<span class="text-sm font-normal">/mois</span></p>
                    <ul class="mb-8">
                        <li class="mb-2">✓ Accès à tous les cours</li>
                        <li class="mb-2">✓ Exercices pratiques</li>
                        <li class="mb-2">✓ Support communautaire</li>
                    </ul>
                    <a href="#"
                        class="block text-center bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded">Choisir ce
                        plan</a>
                </div>

                <!-- Premium Plan -->
                <div class="bg-gray-700 p-8 rounded-lg w-80 transform scale-105 shadow-lg">
                    <h3 class="text-2xl font-bold mb-4">Premium</h3>
                    <p class="text-3xl font-bold mb-6">$99<span class="text-sm font-normal">/mois</span></p>
                    <ul class="mb-8">
                        <li class="mb-2">✓ Tout du plan Basic</li>
                        <li class="mb-2">✓ Certifications incluses</li>
                        <li class="mb-2">✓ Projets guidés</li>
                        <li class="mb-2">✓ Support prioritaire</li>
                    </ul>
                    <a href="#"
                        class="block text-center bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded">Choisir ce
                        plan</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Cours populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Course Card -->
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Introduction au Machine Learning</h3>
                        <p class="text-gray-400 mb-4">Apprenez les bases du ML avec Python</p>
                        <a href="#" class="text-purple-400 hover:underline">En savoir plus</a>
                    </div>
                </div>
                <!-- Repeat for other courses -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 XLearn. Tous droits réservés.</p>
            <div class="mt-4">
                <a href="#" class="text-gray-400 hover:text-white mx-2">Conditions d'utilisation</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Politique de confidentialité</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Contact</a>
            </div>
        </div>
    </footer>
    {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> --}}
</body>

</html>
