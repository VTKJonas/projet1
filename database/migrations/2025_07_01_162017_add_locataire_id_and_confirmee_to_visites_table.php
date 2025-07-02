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
        Schema::table('visites', function (Blueprint $table) {
            $table->foreignId('locataire_id')
                  ->nullable()
                  ->constrained('locataires')
                  ->onDelete('set null');

            $table->boolean('confirmee')->default(false)->after('motif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visites', function (Blueprint $table) {
            $table->dropForeign(['locataire_id']);
            $table->dropColumn('locataire_id');
            $table->dropColumn('confirmee');
        });
    }
};
