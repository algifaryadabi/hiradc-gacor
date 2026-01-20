<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('can_create_documents', function (Blueprint $table) {
            $table->id('id_create_documents');
            $table->string('pic', 10); // 'Ya' atau 'Tidak'
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
        
        // Insert data master
        DB::table('can_create_documents')->insert([
            [
                'id_create_documents' => 0,
                'pic' => 'Tidak',
                'deskripsi' => 'User tidak bertanggung jawab atas form HIRADC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_create_documents' => 1,
                'pic' => 'Ya',
                'deskripsi' => 'User bertanggung jawab atas form HIRADC (PIC)',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('can_create_documents');
    }
};
