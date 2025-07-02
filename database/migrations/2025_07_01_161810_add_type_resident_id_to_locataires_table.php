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
            $table->foreignId('type_resident_id')
                  ->nullable()
                  ->constrained('type_residents')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locataires', function (Blueprint $table) {
            $table->dropForeign(['type_resident_id']);
            $table->dropColumn('type_resident_id');
        });
    }
};
