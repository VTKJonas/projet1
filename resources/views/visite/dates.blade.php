@extends('layouts.app')

@section('title', 'Dates des Visites')

@section('content')
    <div class="bg-white border border-telegramBorder rounded-xl shadow-lg overflow-hidden p-6">
        <h1 class="text-3xl font-bold text-telegramAccent mb-8 text-center">Dates des Visites</h1>

        @if(session('success'))
            <div class="bg-telegramSuccessBg text-telegramSuccessText px-4 py-3 rounded mb-6 text-center border border-green-400">
                {{ session('success') }}
            </div>
        @endif

        @forelse($datesVisites as $dateVisite)
            <div class="mb-4 p-4 bg-telegramBg rounded-lg border border-telegramBorder flex items-center justify-between">
                <p class="text-lg font-semibold">
                    <i class="ti ti-calendar-event mr-2 text-telegramAccent"></i>
                    {{ \Carbon\Carbon::parse($dateVisite->date)->format('d F Y') }}
                </p>
                <!-- Lien pour voir les visites de cette date (fonctionnalité à implémenter) -->
                <a href="{{ route('visites.liste', ['date' => $dateVisite->date]) }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-telegramAccent hover:bg-blue-700 transition duration-200 shadow-md">
                    <i class="ti ti-eye mr-2"></i> Voir les visites
                </a>
            </div>
        @empty
            <div class="text-center py-4 text-gray-500 italic">
                Aucune date de visite enregistrée pour le moment.
            </div>
        @endforelse

        <div class="mt-8 text-center">
            <a href="{{ route('visites.liste') }}"
               class="inline-flex items-center px-6 py-2 text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition duration-200 shadow-md">
                <i class="ti ti-arrow-left mr-2"></i> Retour à la liste des visites
            </a>
        </div>
    </div>
@endsection
