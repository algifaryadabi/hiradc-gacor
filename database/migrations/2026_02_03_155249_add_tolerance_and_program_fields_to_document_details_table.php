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
            // Add new tolerance and program columns
            $table->enum('kolom18_toleransi', ['Ya', 'Tidak'])->nullable();
            $table->boolean('kolom18_auto')->default(false);
            $table->text('kolom19_rencana')->nullable();
            $table->enum('kolom19_program_type', ['PUK', 'PMK'])->nullable();
            $table->unsignedBigInteger('kolom19_program_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->dropColumn([
                'kolom18_toleransi',
                'kolom18_auto',
                'kolom19_rencana',
                'kolom19_program_type',
                'kolom19_program_id'
            ]);
        });
    }
};
