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
        Schema::table('document_details', function (Blueprint $table) {
            $table->dropColumn([
                'residual_kemungkinan', 
                'residual_konsekuensi', 
                'residual_score', 
                'residual_level'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->integer('residual_kemungkinan')->default(1);
            $table->integer('residual_konsekuensi')->default(1);
            $table->integer('residual_score')->default(1);
            $table->string('residual_level')->default('Rendah');
        });
    }
};
