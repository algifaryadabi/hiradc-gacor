<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('can_create_document', function (Blueprint $table) {
            $table->tinyInteger('id_can_create_document')->primary();
            $table->string('pic', 10);
            $table->text('deskripsi');
            $table->timestamps();
            $table->tinyInteger('status_aktif')->default(1);
        });

        // Insert reference data moved to seeder/manual
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('can_create_document');
    }
};
