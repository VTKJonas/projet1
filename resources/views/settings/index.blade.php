@extends('layouts.app')

@section('title', 'Paramètres de l\'Application')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg overflow-hidden p-6 dark:bg-dark-telegramBg dark:border-dark-telegramBorder">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center dark:text-dark-telegramAccent">Paramètres de l'Application</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6 border border-red-400">
                <p class="font-bold">Oups ! Il y a eu des problèmes avec votre soumission :</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('settings.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nom de l'application -->
            <div>
                <label for="app_name" class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Nom de l'Application</label>
                <input type="text" id="app_name" name="app_name" value="{{ old('app_name', $settings['app_name']) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent dark:bg-gray-700 dark:border-dark-telegramBorder dark:text-dark-telegramText dark:focus:ring-dark-telegramAccent dark:focus:border-dark-telegramAccent" required>
                @error('app_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Logo de l'application -->
            <div>
                <label for="app_logo" class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Logo de l'Application</label>
                <input type="file" id="app_logo" name="app_logo"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent dark:bg-gray-700 dark:border-dark-telegramBorder dark:text-dark-telegramText dark:focus:ring-dark-telegramAccent dark:focus:border-dark-telegramAccent">
                @error('app_logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                @if($settings['app_logo'])
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Logo actuel :</p>
                        <img src="{{ Storage::url($settings['app_logo']) }}" alt="Logo actuel" class="mt-2 h-20 w-auto object-contain rounded-md border border-telegramBorder dark:border-dark-telegramBorder">
                    </div>
                @endif
            </div>

            <!-- Adresse -->
            <div>
                <label for="address" class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Adresse</label>
                <input type="text" id="address" name="address" value="{{ old('address', $settings['address']) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent dark:bg-gray-700 dark:border-dark-telegramBorder dark:text-dark-telegramText dark:focus:ring-dark-telegramAccent dark:focus:border-dark-telegramAccent" required>
                @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Numéro de téléphone -->
            <div>
                <label for="phone_number" class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Numéro de Téléphone</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $settings['phone_number']) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent dark:bg-gray-700 dark:border-dark-telegramBorder dark:text-dark-telegramText dark:focus:ring-dark-telegramAccent dark:focus:border-dark-telegramAccent" required>
                @error('phone_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Nom du Responsable -->
            <div>
                <label for="boss_name" class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Nom du Responsable</label>
                <input type="text" id="boss_name" name="boss_name" value="{{ old('boss_name', $settings['boss_name']) }}"
                       class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent dark:bg-gray-700 dark:border-dark-telegramBorder dark:text-dark-telegramText dark:focus:ring-dark-telegramAccent dark:focus:border-dark-telegramAccent" required>
                @error('boss_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Géolocalisation (Latitude et Longitude) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="geolocation_lat" class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Latitude</label>
                    <input type="text" id="geolocation_lat" name="geolocation_lat" value="{{ old('geolocation_lat', $settings['geolocation_lat']) }}"
                           class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent dark:bg-gray-700 dark:border-dark-telegramBorder dark:text-dark-telegramText dark:focus:ring-dark-telegramAccent dark:focus:border-dark-telegramAccent">
                    @error('geolocation_lat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="geolocation_lng" class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Longitude</label>
                    <input type="text" id="geolocation_lng" name="geolocation_lng" value="{{ old('geolocation_lng', $settings['geolocation_lng']) }}"
                           class="w-full px-3 py-2 bg-white border border-telegramBorder rounded-md focus:ring-telegramAccent focus:border-telegramAccent dark:bg-gray-700 dark:border-dark-telegramBorder dark:text-dark-telegramText dark:focus:ring-dark-telegramAccent dark:focus:border-dark-telegramAccent">
                    @error('geolocation_lng') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Sélection du Thème (Mode Clair/Sombre) -->
            <div>
                <label class="block text-sm font-medium text-telegramText mb-1 dark:text-dark-telegramText">Thème de l'Application</label>
                <div class="mt-2 space-y-2">
                    <div class="flex items-center">
                        <input type="radio" id="theme_light" name="app_theme" value="light"
                               class="focus:ring-telegramAccent h-4 w-4 text-telegramAccent border-gray-300 dark:text-dark-telegramAccent dark:border-gray-600"
                               {{ old('app_theme', $settings['app_theme']) == 'light' ? 'checked' : '' }}>
                        <label for="theme_light" class="ml-2 block text-sm text-telegramText dark:text-dark-telegramText">
                            <i class="ti ti-sun mr-1 text-yellow-500"></i> Mode Clair
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="theme_dark" name="app_theme" value="dark"
                               class="focus:ring-telegramAccent h-4 w-4 text-telegramAccent border-gray-300 dark:text-dark-telegramAccent dark:border-gray-600"
                               {{ old('app_theme', $settings['app_theme']) == 'dark' ? 'checked' : '' }}>
                        <label for="theme_dark" class="ml-2 block text-sm text-telegramText dark:text-dark-telegramText">
                            <i class="ti ti-moon mr-1 text-blue-500"></i> Mode Sombre
                        </label>
                    </div>
                </div>
                @error('app_theme') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Boutons Enregistrer et Réinitialiser -->
            <div class="flex justify-end mt-6 space-x-4">
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md">
                    <i class="ti ti-device-floppy mr-2"></i> Enregistrer les Paramètres
                </button>

                <form action="{{ route('settings.reset') }}" method="POST"
                      onsubmit="return confirm('Voulez-vous vraiment réinitialiser tous les paramètres aux valeurs par défaut ?')">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 transition duration-200 shadow-md">
                        <i class="ti ti-rotate-left mr-2"></i> Réinitialiser
                    </button>
                </form>

                {{-- Bouton pour supprimer TOUS les paramètres (à utiliser avec prudence !) --}}
                <form action="{{ route('settings.clearAll') }}" method="POST"
                      onsubmit="return confirm('ATTENTION : Voulez-vous vraiment supprimer TOUS les paramètres ? Cette action est irréversible et réinitialisera l\'application à son état par défaut !')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition duration-200 shadow-md">
                        <i class="ti ti-x-circle mr-2"></i> Supprimer tout
                    </button>
                </form>
            </div>
        </form>
    </div>
@endsection
