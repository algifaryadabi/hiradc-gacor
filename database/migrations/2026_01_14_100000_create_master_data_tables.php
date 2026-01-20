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
        // 1. Master Matriks Risiko (5x5 grid)
        Schema::create('master_matriks_risiko', function (Blueprint $table) {
            $table->id();
            $table->integer('kemungkinan'); // 1-5
            $table->integer('konsekuensi'); // 1-5
            $table->integer('score'); // kemungkinan × konsekuensi
            $table->string('level'); // RENDAH, SEDANG, TINGGI, SANGAT TINGGI
            $table->string('warna')->nullable(); // Hex color for UI
            $table->timestamps();
            
            // Unique constraint
            $table->unique(['kemungkinan', 'konsekuensi']);
        });

        // 2. Master Kemungkinan (Likelihood)
        Schema::create('master_kemungkinan', function (Blueprint $table) {
            $table->id();
            $table->integer('level'); // 1-5
            $table->string('nama'); // Sangat Jarang, Jarang, etc.
            $table->text('deskripsi');
            $table->string('frekuensi')->nullable(); // e.g., "< 1 kali/tahun"
            $table->timestamps();
            
            $table->unique('level');
        });

        // 3. Master Konsekuensi K3
        Schema::create('master_konsekuensi_k3', function (Blueprint $table) {
            $table->id();
            $table->integer('level'); // 1-5
            $table->string('nama'); // P3K, Hilang Hari Kerja, etc.
            $table->text('deskripsi');
            $table->text('dampak')->nullable();
            $table->timestamps();
            
            $table->unique('level');
        });

        // 4. Master Konsekuensi Lingkungan
        Schema::create('master_konsekuensi_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->integer('level'); // 1-5
            $table->string('nama');
            $table->text('deskripsi');
            $table->text('dampak')->nullable();
            $table->timestamps();
            
            $table->unique('level');
        });

        // 5. Master Konsekuensi Keamanan
        Schema::create('master_konsekuensi_keamanan', function (Blueprint $table) {
            $table->id();
            $table->integer('level'); // 1-5
            $table->string('nama');
            $table->text('deskripsi');
            $table->text('dampak')->nullable();
            $table->timestamps();
            
            $table->unique('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_konsekuensi_keamanan');
        Schema::dropIfExists('master_konsekuensi_lingkungan');
        Schema::dropIfExists('master_konsekuensi_k3');
        Schema::dropIfExists('master_kemungkinan');
        Schema::dropIfExists('master_matriks_risiko');
    }
};
