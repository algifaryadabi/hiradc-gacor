<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_direktorat')->nullable();
            $table->unsignedInteger('id_dept')->nullable();
            $table->unsignedInteger('id_unit')->nullable();
            $table->unsignedInteger('id_seksi')->nullable();

            // Status & Approval
            $table->enum('kategori', ['K3', 'KO', 'Lingkungan', 'Keamanan'])->default('K3');
            $table->string('status')->default('draft'); // draft, pending_level1, pending_level2, pending_level3, approved, rejected, revision
            $table->integer('current_level')->default(0); // 0=draft, 1, 2, 3

            // Form Fields - Kolom 2
            $table->string('kolom2_proses')->nullable();
            $table->text('kolom2_kegiatan')->nullable();

            // Kolom 3
            $table->string('kolom3_lokasi')->nullable();

            // Kolom 5
            $table->string('kolom5_kondisi')->nullable();

            // Kolom 6
            $table->text('kolom6_bahaya')->nullable();

            // Kolom 7
            $table->text('kolom7_dampak')->nullable();

            // Kolom 8 - JSON array of affected parties
            $table->json('kolom8_pihak')->nullable();

            // Kolom 9
            $table->text('kolom9_risiko')->nullable();

            // Kolom 10 - JSON array of control hierarchy
            $table->json('kolom10_pengendalian')->nullable();

            // Kolom 11
            $table->text('kolom11_existing')->nullable();

            // Kolom 12-14 Risk Assessment
            $table->integer('kolom12_kemungkinan')->nullable();
            $table->integer('kolom13_konsekuensi')->nullable();
            $table->integer('kolom14_score')->nullable();
            $table->string('kolom14_level')->nullable(); // Rendah, Sedang, Tinggi

            // Kolom 15
            $table->text('kolom15_regulasi')->nullable();

            // Kolom 16
            $table->string('kolom16_aspek')->nullable();

            // Kolom 17
            $table->text('kolom17_risiko')->nullable();
            $table->text('kolom17_peluang')->nullable();

            // Kolom 18-22
            $table->text('kolom18_tindak_lanjut')->nullable();

            // Residual Risk
            $table->integer('residual_kemungkinan')->nullable();
            $table->integer('residual_konsekuensi')->nullable();
            $table->integer('residual_score')->nullable();
            $table->string('residual_level')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Index for performance
            $table->index('id_user');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
