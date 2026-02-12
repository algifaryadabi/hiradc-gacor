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
        // 1. Create History Table
        Schema::create('tr_document_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents', 'id')->onDelete('cascade');
            $table->integer('revision_number')->default(0);
            $table->text('revision_reason')->nullable();


            // Who triggered the archive/revision
            $table->unsignedBigInteger('archived_by')->nullable();
            $table->foreign('archived_by')->references('id_user')->on('users')->nullOnDelete();


            // Detailed Snapshot (JSON) - Stores 'details', 'approvals', 'main_document'
            $table->longText('snapshot_data')->nullable(); // JSON

            $table->timestamp('archived_at')->useCurrent();
            $table->timestamps();
        });

        // 2. Add Revision Management Columns to Documents Table
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'revision_number')) {
                $table->integer('revision_number')->default(0)->after('status');
            }
            if (!Schema::hasColumn('documents', 'revision_reason')) {
                $table->text('revision_reason')->nullable()->after('revision_number');
            }
            if (!Schema::hasColumn('documents', 'last_review_date')) {
                $table->date('last_review_date')->nullable()->after('published_at');
            }
            if (!Schema::hasColumn('documents', 'is_need_evaluation')) {
                $table->boolean('is_need_evaluation')->default(false)->after('last_review_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn([
                'revision_number',
                'revision_reason',
                'last_review_date',
                'is_need_evaluation'
            ]);
        });

        Schema::dropIfExists('tr_document_histories');
    }
};
