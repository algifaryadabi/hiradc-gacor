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
            // Add conditional fields for Lingkungan category (Column 7)
            $table->json('kolom7_aspek_lingkungan')->nullable()->after('kolom6_bahaya');

            // Add conditional fields for Keamanan category (Column 8)
            $table->json('kolom8_ancaman')->nullable()->after('kolom7_aspek_lingkungan');

            // Remove old kolom18_tindak_lanjut (no longer used in new structure)
            $table->dropColumn('kolom18_tindak_lanjut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->dropColumn(['kolom7_aspek_lingkungan', 'kolom8_ancaman']);
            $table->text('kolom18_tindak_lanjut')->after('kolom17_peluang');
        });
    }
};
