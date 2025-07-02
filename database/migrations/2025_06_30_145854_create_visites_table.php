<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->date('date');
            $table->time('heure_arrivee');
            $table->string('motif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
