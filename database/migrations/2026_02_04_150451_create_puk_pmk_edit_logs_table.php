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
        Schema::create('puk_program_edit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puk_program_id');
            $table->unsignedBigInteger('edited_by');
            $table->json('old_data')->nullable(); // Snapshot data sebelumnya
            $table->json('new_data'); // Data baru
            $table->string('edit_type')->default('update'); // update, create, delete
            $table->timestamps();

            $table->foreign('puk_program_id')->references('id')->on('puk_programs')->onDelete('cascade');
            $table->foreign('edited_by')->references('id')->on('users');
        });

        Schema::create('pmk_program_edit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pmk_program_id');
            $table->unsignedBigInteger('edited_by');
            $table->json('old_data')->nullable();
            $table->json('new_data');
            $table->string('edit_type')->default('update');
            $table->timestamps();

            $table->foreign('pmk_program_id')->references('id')->on('pmk_programs')->onDelete('cascade');
            $table->foreign('edited_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmk_program_edit_logs');
        Schema::dropIfExists('puk_program_edit_logs');
    }
};
