<div class="mb-4">
    <label for="locataire_id" class="block text-sm font-medium text-gray-700 mb-1">Locataire concerné</label>
    <select name="locataire_id" id="locataire_id" required
            class="w-full px-3 py-2 bg-white border border-bordure rounded-md">
        <option value="">-- Choisir un locataire --</option>
        @foreach($locataires as $locataire)
            <option value="{{ $locataire->id }}">
                {{ $locataire->nom }} {{ $locataire->prenom }}
            </option>
        @endforeach
    </select>
</div>
