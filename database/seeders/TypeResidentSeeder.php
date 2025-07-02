<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeResident;
use Illuminate\Support\Facades\Schema; // N'oubliez pas d'importer Schema

class TypeResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clés étrangères
        Schema::disableForeignKeyConstraints();

        // Supprime les types existants pour éviter les doublons si le seeder est exécuté plusieurs fois
        TypeResident::truncate();

        // Réactiver les contraintes de clés étrangères après le truncate
        Schema::enableForeignKeyConstraints();

        TypeResident::create(['libelle' => 'Propriétaire']);
        TypeResident::create(['libelle' => 'Locataire']);
        TypeResident::create(['libelle' => 'Colocataire']);
        TypeResident::create(['libelle' => 'Famille']);
        TypeResident::create(['libelle' => 'Autre']);

        $this->command->info('Types de résidents ajoutés !');
    }
}
