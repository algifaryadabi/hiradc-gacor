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
            // SHE Workflow
            $table->enum('status_she', ['none', 'pending_head', 'pending_reviewer', 'pending_verificator', 'pending_head_final', 'approved', 'revision'])->default('none')->after('status');
            $table->unsignedBigInteger('she_current_approver_id')->nullable()->after('status_she');
            $table->unsignedBigInteger('she_reviewer_id')->nullable()->after('she_current_approver_id');
            $table->unsignedBigInteger('she_verificator_id')->nullable()->after('she_reviewer_id');
            $table->timestamp('she_approved_at')->nullable()->after('she_verificator_id');

            // Security Workflow
            $table->enum('status_security', ['none', 'pending_head', 'pending_reviewer', 'pending_verificator', 'pending_head_final', 'approved', 'revision'])->default('none')->after('she_approved_at');
            $table->unsignedBigInteger('security_current_approver_id')->nullable()->after('status_security');
            $table->unsignedBigInteger('security_reviewer_id')->nullable()->after('security_current_approver_id');
            $table->unsignedBigInteger('security_verificator_id')->nullable()->after('security_reviewer_id');
            $table->timestamp('security_approved_at')->nullable()->after('security_verificator_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn([
                'status_she',
                'she_current_approver_id',
                'she_reviewer_id',
                'she_verificator_id',
                'she_approved_at',
                'status_security',
                'security_current_approver_id',
                'security_reviewer_id',
                'security_verificator_id',
                'security_approved_at',
            ]);
        });
    }
};
