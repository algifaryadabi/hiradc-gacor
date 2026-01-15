<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('unit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_probis')->nullable()->after('id_unit');
            // Assuming business_processes table exists. If validation fails, ensure order of migration.
            // $table->foreign('id_probis')->references('id')->on('business_processes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit', function (Blueprint $table) {
            $table->dropColumn('id_probis');
        });
    }
};
