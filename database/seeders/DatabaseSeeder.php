<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'un utilisateur de test (si non déjà fait via Tinker)
        // Vous pouvez commenter cette ligne si vous avez déjà un utilisateur admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Appeler les seeders pour les types de résidents et les locataires
        $this->call([
            TypeResidentSeeder::class, // Doit être appelé en premier
            LocataireSeeder::class,    // Dépend de TypeResidentSeeder
            // Ajoutez d'autres seeders ici si vous en avez (ex: VisiteSeeder si vous voulez des visites pré-remplies)
        ]);

        $this->command->info('Base de données initialisée avec les données de test !');
    }
}
