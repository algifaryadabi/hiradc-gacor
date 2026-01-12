<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('document_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('document_id');
            $table->integer('level'); // 1, 2, or 3
            $table->unsignedInteger('approver_id');
            $table->string('action'); // approved, revised, edited
            $table->text('catatan')->nullable();
            $table->json('changes')->nullable(); // Store what fields were changed
            $table->timestamps();

            $table->index('document_id');
            $table->index('approver_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_approvals');
    }
};
