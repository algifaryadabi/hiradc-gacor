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
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('can_create_document')->default(0)->after('role_jabatan');

            $table->foreign('can_create_document')
                ->references('id_can_create_document')
                ->on('can_create_document')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['can_create_document']);
            $table->dropColumn('can_create_document');
        });
    }
};
