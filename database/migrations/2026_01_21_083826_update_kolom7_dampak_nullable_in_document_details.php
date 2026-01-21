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
        Schema::table('document_details', function (Blueprint $table) {
            // Drop kolom7_dampak as it's no longer used in the new structure
            // We now use kolom9_risiko as the universal field for all categories
            $table->dropColumn('kolom7_dampak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->text('kolom7_dampak')->after('kolom8_ancaman');
        });
    }
};
