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
        // Change columns to VARCHAR(100) to support all status strings
        // Using raw SQL for safety against Enum issues
        DB::statement("ALTER TABLE documents MODIFY COLUMN status_she VARCHAR(100) NULL DEFAULT NULL");
        DB::statement("ALTER TABLE documents MODIFY COLUMN status_security VARCHAR(100) NULL DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to ENUM or original state if needed. 
        // For safe rollback, maybe just leave as varchar or try to restate enum.
        // Assuming previous was enum('pending', 'approved', 'rejected') or similar.
        // We will leave as varchar to prevent data loss on rollback.
    }
};
