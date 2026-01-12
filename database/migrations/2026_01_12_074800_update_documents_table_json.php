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
            // Drop old columns if needed or just change
            // Since we are in dev, we can drop and recreate or change
            // Changing text to json might be tricky if data exists, but assuming empty/test data

            // Drop kolom8_pihak as requested
            $table->dropColumn('kolom8_pihak');

            // Change kolom6_bahaya to JSON
            // We strip current column and re-add as JSON to avoid type cast issues in some DBs
            // Or use change() if supported. Let's drop and add for safety in dev env.
            $table->dropColumn('kolom6_bahaya');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->json('kolom6_bahaya')->nullable()->after('kolom5_kondisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('kolom6_bahaya');
            $table->json('kolom8_pihak')->nullable();
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->text('kolom6_bahaya')->nullable()->after('kolom5_kondisi');
        });
    }
};
