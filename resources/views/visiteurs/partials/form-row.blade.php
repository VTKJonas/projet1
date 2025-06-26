@php $prefix = "visiteurs[$index]"; @endphp

<div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-4">
    <div>
        <input type="text" name="{{ $prefix }}[nom]" placeholder="Nom"
               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
    </div>
    <div>
        <input type="text" name="{{ $prefix }}[prenom]" placeholder="Prénom"
               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
    </div>
    <div>
        <input type="date" name="{{ $prefix }}[date]"
               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
    </div>
    <div>
        <input type="time" name="{{ $prefix }}[heure_arrivee]"
               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
    </div>
    <div>
        <input type="time" name="{{ $prefix }}[heure_depart]"
               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
    </div>
    <div>
        <input type="text" name="{{ $prefix }}[motif]" placeholder="Motif"
               class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
    </div>
</div>
