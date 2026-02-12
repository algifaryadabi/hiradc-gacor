<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            // Add new unified scope columns
            $table->enum('scope_category', ['proses_bisnis', 'kegiatan', 'aset'])
                ->nullable()
                ->comment('Category of scope: business process, activity, or asset');

            $table->text('scope_value')
                ->nullable()
                ->comment('Value of the selected scope');
        });

        // Migrate existing data from kolom2_proses and kolom2_kegiatan
        // Priority: proses takes precedence over kegiatan if both exist
        DB::statement("
            UPDATE document_details 
            SET scope_category = 'proses_bisnis',
                scope_value = kolom2_proses
            WHERE kolom2_proses IS NOT NULL 
              AND kolom2_proses != ''
        ");

        DB::statement("
            UPDATE document_details 
            SET scope_category = 'kegiatan',
                scope_value = kolom2_kegiatan
            WHERE (kolom2_proses IS NULL OR kolom2_proses = '')
              AND kolom2_kegiatan IS NOT NULL 
              AND kolom2_kegiatan != ''
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->dropColumn(['scope_category', 'scope_value']);
        });
    }
};
