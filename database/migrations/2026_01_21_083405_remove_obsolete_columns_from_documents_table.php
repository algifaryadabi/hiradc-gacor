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
        Schema::table('documents', function (Blueprint $table) {
            // Remove obsolete columns that are no longer used in new 22-column structure
            $table->dropColumn(['kolom7_dampak', 'kolom8_pihak', 'kolom18_tindak_lanjut']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->text('kolom7_dampak')->nullable()->after('kolom6_bahaya');
            $table->json('kolom8_pihak')->nullable()->after('kolom7_dampak');
            $table->text('kolom18_tindak_lanjut')->nullable()->after('kolom17_peluang');
        });
    }
};
