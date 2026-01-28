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
            $table->json('compliance_checklist_she')->nullable()->after('compliance_checklist');
            $table->json('compliance_checklist_security')->nullable()->after('compliance_checklist_she');
        });

        // Migrate existing data
        $documents = \DB::table('documents')->whereNotNull('compliance_checklist')->get();
        foreach ($documents as $doc) {
            $checklist = json_decode($doc->compliance_checklist, true);
            if ($checklist) {
                $update = [];
                if (isset($checklist['she'])) {
                    $update['compliance_checklist_she'] = json_encode($checklist['she']);
                }
                if (isset($checklist['security'])) {
                    $update['compliance_checklist_security'] = json_encode($checklist['security']);
                }

                if (!empty($update)) {
                    \DB::table('documents')->where('id', $doc->id)->update($update);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['compliance_checklist_she', 'compliance_checklist_security']);
        });
    }
};
