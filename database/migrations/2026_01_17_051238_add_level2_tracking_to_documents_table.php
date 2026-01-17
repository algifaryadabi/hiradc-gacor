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
        Schema::table('documents', function (Blueprint $table) {
            // Columns for Unit Pengelola Internal Workflow
            $table->string('level2_status')->nullable()->after('status'); // e.g. assigned_review, assigned_approval, returned_to_head
            $table->unsignedBigInteger('level2_reviewer_id')->nullable()->after('level2_status');
            $table->unsignedBigInteger('level2_approver_id')->nullable()->after('level2_reviewer_id');
            $table->timestamp('level2_assignment_date')->nullable()->after('level2_approver_id');

            // Foreign keys if needed (optional since users table always exists, but good for integrity)
            // Avoiding strict constraints for now to prevent issues if users are hard deleted, but typically good practice.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['level2_status', 'level2_reviewer_id', 'level2_approver_id', 'level2_assignment_date']);
        });
    }
};
