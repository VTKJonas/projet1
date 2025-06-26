<!DOCTYPE html>
<html>
<head>
    <title>Formulaire Visiteurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'deep-blue': '#1e3a8a', // Bleu foncé personnalisé
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-deep-blue min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden p-6">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Ajouter plusieurs visiteurs</h1>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('visiteurs.store') }}" class="space-y-6">
                @csrf
                <div x-data="{ visiteurs: [{ nom: '', prenom: '', sexe: 'M', date: '', heure_arrivee: '', heure_depart: '', motif: '' }] }">
                    <template x-for="(visiteur, index) in visiteurs" :key="index">
                        <div class="grid grid-cols-1 md:grid-cols-7 gap-4 mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <!-- Nom -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                <input type="text" x-model="visiteur.nom" :name="`visiteurs[${index}][nom]`" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <!-- Prénom -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                <input type="text" x-model="visiteur.prenom" :name="`visiteurs[${index}][prenom]`" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <!-- Sexe -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sexe</label>
                                <select x-model="visiteur.sexe" :name="`visiteurs[${index}][sexe]`" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            
                            <!-- Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="date" x-model="visiteur.date" :name="`visiteurs[${index}][date]`" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <!-- Heure arrivée -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Arrivée</label>
                                <input type="time" x-model="visiteur.heure_arrivee" :name="`visiteurs[${index}][heure_arrivee]`" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <!-- Heure départ -->
                            
                            <!-- Motif -->
                            <div class="md:col-span-1 flex items-end space-x-2">
                                <div class="flex-grow">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Motif</label>
                                    <input type="text" x-model="visiteur.motif" :name="`visiteurs[${index}][motif]`" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <button type="button" @click="visiteurs.splice(index, 1)" 
                                        class="text-red-600 hover:text-red-800 p-2" x-show="visiteurs.length > 1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <div class="flex space-x-4 mt-6">
                        <button type="button" @click="visiteurs.push({ nom: '', prenom: '', sexe: 'M', date: '', heure_arrivee: '', heure_depart: '', motif: '' })" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajouter un visiteur
                        </button>

                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Enregistrer tous les visiteurs
                        </button>
                        <button>
                            <a href="{{ url('/locataires/create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                Ajouter un locataire
                            </a>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>