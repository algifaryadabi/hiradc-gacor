<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop role_user table
        Schema::dropIfExists('role_user');

        // Drop user_aktif_status table  
        Schema::dropIfExists('user_aktif_status');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate role_user table if rolled back
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('id_role_user')->primary();
            $table->string('nama_role', 50);
            $table->text('deskripsi')->nullable();
            $table->longText('permissions')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });

        // Insert default data
        DB::table('role_user')->insert([
            ['id_role_user' => 1, 'nama_role' => 'Admin', 'deskripsi' => 'Akses penuh ke seluruh sistem', 'permissions' => null, 'status_aktif' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_role_user' => 2, 'nama_role' => 'User', 'deskripsi' => 'Akses administratif terbatas', 'permissions' => null, 'status_aktif' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Recreate user_aktif_status table if rolled back
        Schema::create('user_aktif_status', function (Blueprint $table) {
            $table->integer('id_status')->primary();
            $table->string('nama_status', 20);
            $table->string('deskripsi', 100)->nullable();
        });

        // Insert default data
        DB::table('user_aktif_status')->insert([
            ['id_status' => 1, 'nama_status' => 'Aktif', 'deskripsi' => 'User aktif dan dapat login'],
            ['id_status' => 2, 'nama_status' => 'Tidak Aktif', 'deskripsi' => 'User tidak aktif, tidak dapat login'],
        ]);
    }
};
