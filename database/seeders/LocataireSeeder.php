<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locataire;
use App\Models\TypeResident;
use Illuminate\Support\Facades\Schema; // N'oubliez pas d'importer Schema

class LocataireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clés étrangères
        Schema::disableForeignKeyConstraints();

        // Supprime les locataires existants
        Locataire::truncate();

        // Réactiver les contraintes de clés étrangères après le truncate
        Schema::enableForeignKeyConstraints();

        // Récupère les types de résident existants
        // Assurez-vous que TypeResidentSeeder a été exécuté en premier
        $typeLocataire = TypeResident::where('libelle', 'Locataire')->first();
        $typeProprietaire = TypeResident::where('libelle', 'Propriétaire')->first();
        $typeColocataire = TypeResident::where('libelle', 'Colocataire')->first();
        $typeFamille = TypeResident::where('libelle', 'Famille')->first();
        $typeAutre = TypeResident::where('libelle', 'Autre')->first();


        // Vérifiez si les types existent avant de les utiliser
        if (!$typeLocataire || !$typeProprietaire) {
            $this->command->error('Veuillez vous assurer que TypeResidentSeeder a été exécuté et a créé les types nécessaires !');
            return;
        }

        Locataire::create([
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'telephone' => '0612345678',
            'batiment' => 'A',
            'type_resident_id' => $typeLocataire->id,
        ]);

        Locataire::create([
            'nom' => 'Martin',
            'prenom' => 'Sophie',
            'telephone' => '0787654321',
            'batiment' => 'B',
            'type_resident_id' => $typeProprietaire->id,
        ]);

        Locataire::create([
            'nom' => 'Lefevre',
            'prenom' => 'Paul',
            'telephone' => '0601020304',
            'batiment' => 'A',
            'type_resident_id' => $typeLocataire->id,
        ]);

        // Exemple d'ajout d'autres locataires pour diversifier
        if ($typeColocataire) {
            Locataire::create([
                'nom' => 'Dubois',
                'prenom' => 'Marie',
                'telephone' => '0711223344',
                'batiment' => 'C',
                'type_resident_id' => $typeColocataire->id,
            ]);
        }

        $this->command->info('Locataires ajoutés !');
    }
}
