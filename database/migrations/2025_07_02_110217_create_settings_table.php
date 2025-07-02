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
        // Crée la table 'settings' pour stocker les paramètres de l'application
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->string('key')->unique(); // Clé du paramètre (ex: 'app_name', 'logo_path')
            $table->text('value')->nullable(); // Valeur du paramètre
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table 'settings' si la migration est annulée
        Schema::dropIfExists('settings');
    }
};
