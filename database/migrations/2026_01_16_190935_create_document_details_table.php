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
        Schema::create('document_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');

            // Content Columns (Moved from documents table)
            $table->string('kategori'); // K3, KO, Lingkungan, Keamanan
            $table->string('kolom2_proses')->nullable();   // Proses/Unit Kerja
            $table->string('kolom2_kegiatan'); // Kegiatan
            $table->string('kolom3_lokasi');   // Lokasi
            $table->string('kolom4_pihak')->nullable(); // Pihak Berkepentingan (optional/new)
            $table->string('kolom5_kondisi');  // Rutin, Non-Rutin, Emergency

            // Bahaya (JSON/Array)
            $table->json('kolom6_bahaya')->nullable(); // List bahaya
            $table->text('bahaya_manual')->nullable(); // Bahaya lain-lain

            $table->text('kolom7_dampak');     // Dampak/Konsekuensi
            $table->text('kolom9_risiko');     // Identifikasi Risiko

            // Penilaian Risiko Awal
            $table->text('kolom10_pengendalian')->nullable(); // Hirarki Pengendalian (JSON)
            $table->text('kolom11_existing');  // Pengendalian Existing (Text)

            $table->integer('kolom12_kemungkinan');
            $table->integer('kolom13_konsekuensi');
            $table->integer('kolom14_score');
            $table->string('kolom14_level');

            // Evaluasi
            $table->text('kolom15_regulasi')->nullable();
            $table->string('kolom16_aspek')->nullable(); // Penting / Tidak Penting

            // Risiko & Peluang (New)
            $table->text('kolom17_risiko')->nullable();
            $table->text('kolom17_peluang')->nullable();

            // Tindak Lanjut & Residual
            $table->text('kolom18_tindak_lanjut');
            $table->string('kolom18_toleransi')->default('Ya');

            $table->integer('residual_kemungkinan');
            $table->integer('residual_konsekuensi');
            $table->integer('residual_score');
            $table->string('residual_level');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_details');
    }
};
