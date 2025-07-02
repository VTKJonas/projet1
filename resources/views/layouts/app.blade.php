<?php
    // Récupérer les paramètres de l'application depuis la base de données
    use App\Models\Setting;
    use Illuminate\Support\Facades\Storage;

    $dynamicSettings = Setting::pluck('value', 'key')->all();

    // Valeurs par défaut si les paramètres n'existent pas encore dans la DB
    $appName = $dynamicSettings['app_name'] ?? 'Gestion App';
    $appLogo = $dynamicSettings['app_logo'] ?? null;
    $appTheme = $dynamicSettings['app_theme'] ?? 'light'; // Thème par défaut: 'light'
?>
<!DOCTYPE html>
<html lang="fr" class="{{ $appTheme === 'dark' ? 'dark' : ($appTheme === 'yellow_soft' ? 'yellow-soft' : '') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $appName)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        // Couleurs de base pour le mode clair
                        telegramBg: '#F0F2F5',
                        telegramText: '#333333',
                        telegramAccent: '#0088CC',
                        telegramBorder: '#E0E0E0',
                        telegramTableHead: '#EBF5FF',
                        telegramSuccessBg: '#D4EDDA',
                        telegramSuccessText: '#155724',
                        telegramHover: '#F0F0F0',
                        telegramFooterBg: '#E0E7EB',
                        telegramFooterText: '#555555',
                        telegramConfirmed: '#28A745',
                        telegramPending: '#FFC107',
                        telegramRejected: '#DC3545',
                        telegramSidebarBlue: '#A7D9F7', // Un bleu clair et doux pour la sidebar
                        telegramSidebarBorder: '#90C3E0', // Une couleur de bordure assortie (légèrement plus foncée)

                        // Couleurs pour le mode sombre (utilisées avec la classe 'dark:')
                        dark: {
                            telegramBg: '#181A1B',
                            telegramText: '#E0E0E0',
                            telegramAccent: '#00BFFF',
                            telegramBorder: '#3A3A3A',
                            telegramTableHead: '#2C2F33',
                            telegramSuccessBg: '#0F3F19',
                            telegramSuccessText: '#6EE7B7',
                            telegramHover: '#2A2D30',
                            telegramFooterBg: '#2C2F33',
                            telegramFooterText: '#AAAAAA',
                            telegramConfirmed: '#1D8348',
                            telegramPending: '#B8860B',
                            telegramRejected: '#A52A2A',
                            telegramTableBodyEven: '#212121',
                            telegramTableBodyOdd: '#282828',
                            telegramTableHover: '#3A3A3A',
                            telegramSidebarBlue: '#1E3A8A', // Un bleu plus foncé pour la sidebar en mode sombre
                            telegramSidebarBorder: '#152C6B', // Une bordure plus foncée pour le mode sombre
                        },

                        // Nouvelle palette pour le mode "Jaune Doux (avec touche de noir)"
                        'yellow-soft': {
                            'bg-primary': '#F5E7B2',
                            'text-primary': '#424242',
                            'accent': '#DAA520',
                            'border': '#E0D29E',
                            'card-bg': '#FFFFFF',
                            'table-head': '#FFFACD',
                            'success-bg': '#DCE775',
                            'success-text': '#689F38',
                            'warning-bg': '#FFD54F',
                            'warning-text': '#FF8F00',
                            'danger-bg': '#FFCDD2',
                            'danger-text': '#D32F2F',
                            'hover': '#EDE2A5',
                            'footer-bg': '#E8DDA0',
                            'footer-text': '#616161',
                            'sidebar-blue': '#8B4513', // Couleur existante pour la sidebar en mode jaune doux
                            'sidebar-border': '#6B350F', // Bordure assortie pour le mode jaune doux
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet" />
</head>
<body class="bg-telegramBg min-h-screen text-telegramText flex
             {{ $appTheme === 'dark' ? 'dark:bg-dark-telegramBg dark:text-dark-telegramText' : '' }}
             {{ $appTheme === 'yellow_soft' ? 'yellow-soft:bg-yellow-soft-bg-primary yellow-soft:text-yellow-soft-text-primary' : '' }}">

    <!-- SIDEBAR -->
    <aside class="bg-telegramSidebarBlue shadow-lg w-64 flex flex-col p-4 border-r border-telegramSidebarBorder
                   dark:bg-dark-telegramSidebarBlue dark:border-dark-telegramSidebarBorder
                   yellow-soft:bg-yellow-soft-sidebar-blue yellow-soft:border-yellow-soft-sidebar-border">
        <div class="flex items-center space-x-3 mb-8">
            {{-- Affichage du logo dynamique ou d'une icône par défaut --}}
            @if($appLogo)
                <img src="{{ Storage::url($appLogo) }}" alt="{{ $appName }} Logo" class="h-8 w-auto object-contain rounded-md">
            @else
                <i class="ti ti-building-store text-gray-800 text-2xl dark:text-white yellow-soft:text-yellow-soft-text-primary"></i>
            @endif
            {{-- Affichage du nom de l'application dynamique --}}
            <span class="text-gray-800 text-xl font-bold dark:text-white yellow-soft:text-yellow-soft-text-primary">{{ $appName }}</span>
        </div>
        <nav class="flex flex-col space-y-2 flex-grow">
            <span class="text-gray-600 text-sm font-semibold uppercase mt-4 mb-2 dark:text-gray-400 yellow-soft:text-yellow-soft-text-primary">Visiteurs</span>
            <a href="{{ url('/visites/create') }}" class="text-gray-800 hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-blue-100 transition duration-150
                dark:text-white dark:hover:text-dark-telegramAccent dark:hover:bg-dark-telegramHover
                yellow-soft:text-yellow-soft-text-primary yellow-soft:hover:text-yellow-soft-accent yellow-soft:hover:bg-yellow-soft-hover">
                <i class="ti ti-user-plus"></i><span>Ajouter visiteur</span>
            </a>
            <a href="{{ url('/visites/liste') }}" class="text-gray-800 hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-blue-100 transition duration-150
                dark:text-white dark:hover:text-dark-telegramAccent dark:hover:bg-dark-telegramHover
                yellow-soft:text-yellow-soft-text-primary yellow-soft:hover:text-yellow-soft-accent yellow-soft:hover:bg-yellow-soft-hover">
                <i class="ti ti-users"></i><span>Liste visiteurs</span>
            </a>
            <a href="{{ route('dates.visite') }}" class="text-gray-800 hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-blue-100 transition duration-150
                dark:text-white dark:hover:text-dark-telegramAccent dark:hover:bg-dark-telegramHover
                yellow-soft:text-yellow-soft-text-primary yellow-soft:hover:text-yellow-soft-accent yellow-soft:hover:bg-yellow-soft-hover">
                <i class="ti ti-calendar"></i><span>Dates des visites</span>
            </a>

            <span class="text-gray-600 text-sm font-semibold uppercase mt-4 mb-2 dark:text-gray-400 yellow-soft:text-yellow-soft-text-primary">Locataires</span>
            <a href="{{ url('/locataires') }}" class="text-gray-800 hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-blue-100 transition duration-150
                dark:text-white dark:hover:text-dark-telegramAccent dark:hover:bg-dark-telegramHover
                yellow-soft:text-yellow-soft-text-primary yellow-soft:hover:text-yellow-soft-accent yellow-soft:hover:bg-yellow-soft-hover">
                <i class="ti ti-users-group"></i><span>Liste locataires</span>
            </a>
            <a href="{{ url('/locataires/create') }}" class="text-gray-800 hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-blue-100 transition duration-150
                dark:text-white dark:hover:text-dark-telegramAccent dark:hover:bg-dark-telegramHover
                yellow-soft:text-yellow-soft-text-primary yellow-soft:hover:text-yellow-soft-accent yellow-soft:hover:bg-yellow-soft-hover">
                <i class="ti ti-user-cog"></i><span>Ajouter locataire</span>
            </a>
            <a href="{{ url('/types-resident') }}" class="text-gray-800 hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-blue-100 transition duration-150
                dark:text-white dark:hover:text-dark-telegramAccent dark:hover:bg-dark-telegramHover
                yellow-soft:text-yellow-soft-text-primary yellow-soft:hover:text-yellow-soft-accent yellow-soft:hover:bg-yellow-soft-hover">
                <i class="ti ti-building-warehouse"></i><span>Types de résident</span>
            </a>

            <span class="text-gray-600 text-sm font-semibold uppercase mt-4 mb-2 dark:text-gray-400 yellow-soft:text-yellow-soft-text-primary">Administration</span>
            <a href="{{ url('/settings') }}" class="text-gray-800 hover:text-telegramAccent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-blue-100 transition duration-150
                dark:text-white dark:hover:text-dark-telegramAccent dark:hover:bg-dark-telegramHover
                yellow-soft:text-yellow-soft-text-primary yellow-soft:hover:text-yellow-soft-accent yellow-soft:hover:bg-yellow-soft-hover">
                <i class="ti ti-settings"></i><span>Paramètres</span>
            </a>

            <div class="mt-auto pt-4 border-t border-blue-200 dark:border-blue-800 yellow-soft:border-yellow-soft-border">
                <a href="{{ url('/logout') }}" class="text-red-600 hover:text-red-800 font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-red-100 transition duration-150
                    dark:text-red-400 dark:hover:text-red-600 dark:hover:bg-red-900
                    yellow-soft:text-yellow-soft-danger-text yellow-soft:hover:text-yellow-soft-danger-text yellow-soft:hover:bg-red-200">
                    <i class="ti ti-logout"></i><span>Déconnexion</span>
                </a>
            </div>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col justify-between">
        <header class="bg-white shadow-sm py-4 px-6 flex justify-end items-center border-b border-telegramBorder
                       dark:bg-dark-telegramBg dark:border-dark-telegramBorder
                       yellow-soft:bg-yellow-soft-card-bg yellow-soft:border-yellow-soft-border">
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="relative p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-telegramAccent
                           dark:hover:bg-dark-telegramHover dark:focus:ring-dark-telegramAccent
                           yellow-soft:hover:bg-yellow-soft-hover yellow-soft:focus:ring-yellow-soft-accent">
                    <i class="ti ti-bell text-2xl text-telegramAccent dark:text-dark-telegramAccent yellow-soft:text-yellow-soft-accent"></i>
                    @if(Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </button>

                <div x-show="open" @click.away="open = false"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50 border border-telegramBorder
                            dark:bg-dark-telegramBg dark:border-dark-telegramBorder yellow-soft:bg-yellow-soft-card-bg yellow-soft:border-yellow-soft-border"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">
                    <div class="px-4 py-2 text-sm text-gray-700 border-b border-telegramBorder dark:text-gray-300 dark:border-dark-telegramBorder yellow-soft:text-yellow-soft-text-primary yellow-soft:border-yellow-soft-border">
                        Notifications non lues
                    </div>
                    @if(Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                        @foreach(Auth::user()->unreadNotifications as $notification)
                            <div class="block px-4 py-3 text-sm text-telegramText border-b border-gray-100 hover:bg-telegramHover
                                dark:text-dark-telegramText dark:border-gray-700 dark:hover:bg-dark-telegramHover
                                yellow-soft:text-yellow-soft-text-primary yellow-soft:border-yellow-soft-border yellow-soft:hover:bg-yellow-soft-hover">
                                <p class="font-semibold">{{ $notification->data['message'] ?? 'Nouvelle notification' }}</p>
                                <p class="text-xs text-gray-500 mt-1 dark:text-gray-400 yellow-soft:text-gray-600">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    {{-- Boutons d'action pour la notification --}}
                                    <form action="{{ route('notifications.accepter', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-telegramConfirmed text-white rounded-md text-xs hover:bg-green-700
                                            dark:bg-dark-telegramConfirmed dark:hover:bg-green-800
                                            yellow-soft:bg-yellow-soft-success-text yellow-soft:hover:bg-yellow-soft-success-bg">Accepter</button>
                                    </form>
                                    <form action="{{ route('notifications.refuser', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-telegramRejected text-white rounded-md text-xs hover:bg-red-600
                                            dark:bg-dark-telegramRejected dark:hover:bg-red-700
                                            yellow-soft:bg-yellow-soft-danger-text yellow-soft:hover:bg-yellow-soft-danger-bg">Refuser</button>
                                    </form>
                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-gray-400 text-white rounded-md text-xs hover:bg-gray-500
                                            dark:bg-gray-600 dark:hover:bg-gray-700
                                            yellow-soft:bg-gray-500 yellow-soft:hover:bg-gray-600">Marquer lue</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="block px-4 py-3 text-sm text-gray-500 italic dark:text-gray-400 yellow-soft:text-gray-600">
                            Aucune notification non lue.
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
            @yield('content')
        </main>

        <footer class="mt-10 py-6 text-center bg-telegramFooterBg text-telegramFooterText rounded-lg shadow-inner w-full
                       dark:bg-dark-telegramFooterBg dark:text-dark-telegramFooterText
                       yellow-soft:bg-yellow-soft-footer-bg yellow-soft:text-yellow-soft-footer-text">
            <p class="mb-4">&copy; {{ date('Y') }} Gestion App. Tous droits réservés.</p>
            <div class="flex justify-center space-x-6 text-2xl">
                <a href="#" class="hover:text-telegramAccent transition duration-150 dark:hover:text-dark-telegramAccent yellow-soft:hover:text-yellow-soft-accent" aria-label="Facebook">
                    <i class="ti ti-brand-facebook"></i>
                </a>
                <a href="#" class="hover:text-telegramAccent transition duration-150 dark:hover:text-dark-telegramAccent yellow-soft:hover:text-yellow-soft-accent" aria-label="Twitter">
                    <i class="ti ti-brand-twitter"></i>
                </a>
                <a href="#" class="hover:text-telegramAccent transition duration-150 dark:hover:text-dark-telegramAccent yellow-soft:hover:text-yellow-soft-accent" aria-label="Instagram">
                    <i class="ti ti-brand-instagram"></i>
                </a>
                <a href="#" class="hover:text-telegramAccent transition duration-150 dark:hover:text-dark-telegramAccent yellow-soft:hover:text-yellow-soft-accent" aria-label="LinkedIn">
                    <i class="ti ti-brand-linkedin"></i>
                </a>
            </div>
        </footer>
    </div>

</body>
</html>
