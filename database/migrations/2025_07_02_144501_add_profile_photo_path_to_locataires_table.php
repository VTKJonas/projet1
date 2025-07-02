<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('locataires', function (Blueprint $table) {
            // Ajoute une colonne nullable pour le chemin de la photo de profil
            $table->string('profile_photo_path', 2048)->nullable()->after('batiment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locataires', function (Blueprint $table) {
            // Supprime la colonne en cas de rollback
            $table->dropColumn('profile_photo_path');
        });
    }
};
