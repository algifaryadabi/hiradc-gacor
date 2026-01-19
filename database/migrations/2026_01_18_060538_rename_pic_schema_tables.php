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
        // 1. Drop Foreign Key on users table
        Schema::table('users', function (Blueprint $table) {
            // Check if foreign key exists first would be ideal, but Laravel usually generates predictable names
            // users_can_create_document_foreign
            $table->dropForeign(['can_create_document']);
        });

        // 2. Rename Table
        Schema::rename('can_create_document', 'can_create_documents');

        // 3. Rename Column in Reference Table
        Schema::table('can_create_documents', function (Blueprint $table) {
            $table->renameColumn('id_can_create_document', 'id_create_documents');
        });

        // 4. Rename Column in Users Table
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('can_create_document', 'can_create_documents');
        });

        // 5. Re-add Foreign Key
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('can_create_documents')
                ->references('id_create_documents')
                ->on('can_create_documents')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse operations
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['can_create_documents']);
        });

        Schema::rename('can_create_documents', 'can_create_document');

        Schema::table('can_create_document', function (Blueprint $table) {
            $table->renameColumn('id_create_documents', 'id_can_create_document');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('can_create_documents', 'can_create_document');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('can_create_document')
                ->references('id_can_create_document')
                ->on('can_create_document')
                ->onDelete('restrict');
        });
    }
};
