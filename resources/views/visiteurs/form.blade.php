<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire des Visiteurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cafe: '#d7ccc8',
                        slateform: '#f5f5f5',
                        accent: '#3B82F6',
                        bordure: '#9e9e9e'
                    }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet" />
</head>
<body class="bg-cafe min-h-screen text-gray-800 flex">
    <aside class="bg-white shadow-lg w-64 flex flex-col p-4">
        <div class="flex items-center space-x-3 mb-8">
            <i class="ti ti-building-store text-accent text-2xl"></i>
            <span class="text-xl font-bold text-accent">Gestion Visiteurs</span>
        </div>
        <nav class="flex flex-col space-y-4">
            <a href="{{ url('/visiteurs/create') }}" class="text-gray-800 hover:text-accent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-gray-100">
                <i class="ti ti-user-plus"></i><span>Ajouter visiteur</span>
            </a>
            <a href="{{ url('/locataires') }}" class="text-gray-800 hover:text-accent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-gray-100">
                <i class="ti ti-users-group"></i><span>Locataires</span>
            </a>
            <a href="{{ url('/locataires/create') }}" class="text-gray-800 hover:text-accent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-gray-100">
                <i class="ti ti-user-cog"></i><span>Ajouter locataire</span>
            </a>
            <a href="{{ url('/types-resident') }}" class="text-gray-800 hover:text-accent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-gray-100">
                <i class="ti ti-building-warehouse"></i><span>Types de résident</span>
            </a>
            <a href="{{ route('dates.visite') }}" class="text-gray-800 hover:text-accent font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-gray-100">
                <i class="ti ti-calendar"></i><span>Dates des visites</span>
            </a>
            <a href="{{ url('/logout') }}" class="text-red-600 hover:text-red-800 font-medium flex items-center space-x-2 p-2 rounded-md hover:bg-red-50">
                <i class="ti ti-logout"></i><span>Déconnexion</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white border border-bordure rounded-xl shadow-xl overflow-hidden p-6">
            <h1 class="text-3xl font-bold text-center text-accent mb-8">Ajouter plusieurs visiteurs</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-6 rounded text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('visiteurs.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div x-data="{ visiteurs: [{ nom: '', prenom: '', sexe: 'M', date: '', heure_arrivee: '', heure_depart: '', motif: '' }] }">
                    <template x-for="(visiteur, index) in visiteurs" :key="index">
                        <div class="grid grid-cols-1 md:grid-cols-8 gap-4 mb-6 p-4 bg-slateform text-gray-800 rounded-lg border border-bordure">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                <input type="text" x-model="visiteur.nom" :name="`visiteurs[${index}][nom]`"
                                       class="w-full px-3 py-2 bg-white border border-bordure rounded-md" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                <input type="text" x-model="visiteur.prenom" :name="`visiteurs[${index}][prenom]`"
                                       class="w-full px-3 py-2 bg-white border border-bordure rounded-md" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sexe</label>
                                <select x-model="visiteur.sexe" :name="`visiteurs[${index}][sexe]`"
                                        class="w-full px-3 py-2 bg-white border border-bordure rounded-md" required>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="date" x-model="visiteur.date" :name="`visiteurs[${index}][date]`"
                                       class="w-full px-3 py-2 bg-white border border-bordure rounded-md" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Arrivée</label>
                                <input type="time" x-model="visiteur.heure_arrivee" :name="`visiteurs[${index}][heure_arrivee]`"
                                       class="w-full px-3 py-2 bg-white border border-bordure rounded-md" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Motif</label>
                                <input type="text" x-model="visiteur.motif" :name="`visiteurs[${index}][motif]`"
                                       class="w-full px-3 py-2 bg-white border border-bordure rounded-md" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                                <input type="file" :name="`visiteurs[${index}][photo]`" accept="image/*"
                                       class="w-full px-3 py-2 bg-white border border-bordure rounded-md">
                            </div>
                            <div class="flex items-end">
                                <button type="button" @click="visiteurs.splice(index, 1)"
                                        class="text-red-600 hover:text-red-800 p-2" x-show="visiteurs.length > 1">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </div>
                    </template>

                    <div class="flex flex-wrap gap-4 mt-6">
                        <button type="button" @click="visiteurs.push({ nom: '', prenom: '', sexe: 'M', date: '', heure_arrivee: '', heure_depart: '', motif: '' })"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-accent hover:bg-blue-700">
                            <i class="ti ti-user-plus mr-2"></i> Ajouter un visiteur
                        </button>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-accent hover:bg-blue-700">
                            <i class="ti ti-device-floppy mr-2"></i> Enregistrer tous les visiteurs
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
