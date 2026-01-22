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
        Schema::table('document_details', function (Blueprint $table) {
            // Split kolom9_risiko into 3 separate fields based on category
            // Each will be nullable - only filled based on category selection

            // For K3/KO category
            $table->text('kolom9_risiko_k3ko')->nullable()->after('kolom8_ancaman');

            // For Lingkungan category  
            $table->text('kolom9_dampak_lingkungan')->nullable()->after('kolom9_risiko_k3ko');

            // For Keamanan category
            $table->text('kolom9_celah_keamanan')->nullable()->after('kolom9_dampak_lingkungan');

            // Keep the old kolom9_risiko for backward compatibility (will be phased out)
            // We'll migrate existing data to appropriate new columns based on kategori
        });

        // Migrate existing data
        DB::statement("
            UPDATE document_details 
            SET kolom9_risiko_k3ko = kolom9_risiko 
            WHERE kategori IN ('K3', 'KO')
        ");

        DB::statement("
            UPDATE document_details 
            SET kolom9_dampak_lingkungan = kolom9_risiko 
            WHERE kategori = 'Lingkungan'
        ");

        DB::statement("
            UPDATE document_details 
            SET kolom9_celah_keamanan = kolom9_risiko 
            WHERE kategori = 'Keamanan'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->dropColumn(['kolom9_risiko_k3ko', 'kolom9_dampak_lingkungan', 'kolom9_celah_keamanan']);
        });
    }
};
