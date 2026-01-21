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
            // Column 19-22: Follow-up Risk Assessment (only if tolerance = "Tidak")
            $table->text('kolom19_pengendalian_lanjut')->nullable()->after('kolom18_toleransi');
            $table->integer('kolom20_kemungkinan_lanjut')->nullable()->after('kolom19_pengendalian_lanjut');
            $table->integer('kolom21_konsekuensi_lanjut')->nullable()->after('kolom20_kemungkinan_lanjut');
            $table->integer('kolom22_tingkat_risiko_lanjut')->nullable()->after('kolom21_konsekuensi_lanjut');
            $table->string('kolom22_level_lanjut')->nullable()->after('kolom22_tingkat_risiko_lanjut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->dropColumn([
                'kolom19_pengendalian_lanjut',
                'kolom20_kemungkinan_lanjut',
                'kolom21_konsekuensi_lanjut',
                'kolom22_tingkat_risiko_lanjut',
                'kolom22_level_lanjut'
            ]);
        });
    }
};
