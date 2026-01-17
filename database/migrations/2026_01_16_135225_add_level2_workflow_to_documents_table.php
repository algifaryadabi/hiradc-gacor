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
            $table->string('level2_status')->nullable()->after('status')
                ->comment('Workflow status for Unit Pengelola: assigned_review, assigned_approval, returned_to_unit_head');
            $table->unsignedBigInteger('level2_reviewer_id')->nullable()->after('level2_status');
            $table->unsignedBigInteger('level2_approver_id')->nullable()->after('level2_reviewer_id');
            $table->timestamp('level2_assignment_date')->nullable()->after('level2_approver_id');

            // Foreign keys if needed, or just keep as integers for simplicity in this step.
            // $table->foreign('level2_reviewer_id')->references('id_user')->on('users');
            // $table->foreign('level2_approver_id')->references('id_user')->on('users');
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
