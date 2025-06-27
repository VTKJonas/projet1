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
         Schema::create('visiteurs', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        // $table->string('sexe'); // supprimé
        $table->date('date');
        $table->time('heure_arrivee');
        $table->string('motif');
        $table->boolean('confirmee')->default(false);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiteurs');
    }
};
