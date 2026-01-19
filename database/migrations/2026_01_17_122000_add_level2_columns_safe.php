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
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('documents', 'level2_status')) {
                $table->string('level2_status')->nullable()->after('status');
            }
            if (!Schema::hasColumn('documents', 'level2_reviewer_id')) {
                $table->unsignedBigInteger('level2_reviewer_id')->nullable()->after('level2_status');
            }
            if (!Schema::hasColumn('documents', 'level2_approver_id')) {
                $table->unsignedBigInteger('level2_approver_id')->nullable()->after('level2_reviewer_id');
            }
            if (!Schema::hasColumn('documents', 'level2_assignment_date')) {
                $table->timestamp('level2_assignment_date')->nullable()->after('level2_approver_id');
            }
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
