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
            // Staff yang ditugaskan untuk handle dokumen ini
            $table->unsignedBigInteger('assigned_staff_id')->nullable()->after('id_user');

            // Kepala Unit yang menugaskan
            $table->unsignedBigInteger('assigned_by')->nullable()->after('assigned_staff_id');

            // Timestamp kapan ditugaskan
            $table->timestamp('assigned_at')->nullable()->after('assigned_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['assigned_staff_id', 'assigned_by', 'assigned_at']);
        });
    }
};
