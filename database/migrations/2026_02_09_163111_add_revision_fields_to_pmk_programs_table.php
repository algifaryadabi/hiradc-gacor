<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pmk_programs', function (Blueprint $table) {
            // Add 'revision' to status enum
            DB::statement("ALTER TABLE pmk_programs MODIFY COLUMN status ENUM('draft', 'pending_kepala_unit', 'pending_kepala_dept', 'pending_direksi', 'approved', 'rejected', 'revision') DEFAULT 'draft'");
            
            // Add revision tracking fields
            $table->text('revision_note')->nullable()->after('rejection_note');
            $table->unsignedBigInteger('revised_by')->nullable()->after('revision_note');
            $table->timestamp('revised_at')->nullable()->after('revised_by');
            $table->timestamp('resubmitted_at')->nullable()->after('revised_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pmk_programs', function (Blueprint $table) {
            // Revert status enum
            DB::statement("ALTER TABLE pmk_programs MODIFY COLUMN status ENUM('draft', 'pending_kepala_unit', 'pending_kepala_dept', 'pending_direksi', 'approved', 'rejected') DEFAULT 'draft'");
            
            // Drop revision fields
            $table->dropColumn(['revision_note', 'revised_by', 'revised_at', 'resubmitted_at']);
        });
    }
};
