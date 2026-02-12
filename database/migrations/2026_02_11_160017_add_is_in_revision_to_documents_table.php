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
        if (!Schema::hasColumn('documents', 'is_in_revision')) {
            Schema::table('documents', function (Blueprint $table) {
                $table->boolean('is_in_revision')->default(false)->after('is_need_evaluation')->comment('Flag to track if document is currently in revision workflow');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('is_in_revision');
        });
    }
};
