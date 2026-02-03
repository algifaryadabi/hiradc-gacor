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
        Schema::create('pmk_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_detail_id');

            // Program fields
            $table->string('judul', 500);
            $table->text('tujuan');
            $table->text('sasaran');
            $table->string('penanggung_jawab', 255);
            $table->text('uraian_revisi')->nullable();
            $table->json('program_kerja'); // [{no, uraian, koord, pelaksana, target:[12]}]

            // Extended workflow fields for PMK (goes to Direksi)
            $table->enum('status', [
                'draft',
                'pending_kepala_unit',
                'pending_kepala_dept',
                'pending_direksi',
                'approved',
                'rejected'
            ])->default('draft');

            $table->unsignedBigInteger('approved_by_kepala_unit')->nullable();
            $table->unsignedBigInteger('approved_by_kepala_dept')->nullable();
            $table->unsignedBigInteger('approved_by_direksi')->nullable();

            $table->timestamp('unit_approval_at')->nullable();
            $table->timestamp('dept_approval_at')->nullable();
            $table->timestamp('direksi_approval_at')->nullable();

            $table->text('rejection_note')->nullable();

            // Audit fields
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            // Foreign keys
            $table->foreign('document_detail_id')->references('id')->on('document_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmk_programs');
    }
};
