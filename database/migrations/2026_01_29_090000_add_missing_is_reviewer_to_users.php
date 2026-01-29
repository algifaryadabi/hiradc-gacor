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
            if (!Schema::hasColumn('users', 'is_reviewer')) {
                $table->boolean('is_reviewer')->default(false)->after('can_create_documents');
            }
            if (!Schema::hasColumn('users', 'is_verifier')) {
                $table->boolean('is_verifier')->default(false)->after('is_reviewer');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_reviewer')) {
                $table->dropColumn('is_reviewer');
            }
            if (Schema::hasColumn('users', 'is_verifier')) {
                $table->dropColumn('is_verifier');
            }
        });
    }
};
