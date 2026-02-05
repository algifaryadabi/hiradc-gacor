<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('document_details', function (Blueprint $table) {
            // Add column for Program Type (PUK/PMK)
            // It should be after kolom18_toleransi or similar
            if (!Schema::hasColumn('document_details', 'kolom19_program_type')) {
                $table->string('kolom19_program_type')->nullable()->after('kolom18_toleransi');
            }
        });
    }

    public function down()
    {
        Schema::table('document_details', function (Blueprint $table) {
            $table->dropColumn('kolom19_program_type');
        });
    }
};
