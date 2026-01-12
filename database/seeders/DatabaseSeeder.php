<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Note: Seeder tidak digunakan karena tabel users sudah ada di database bersama.
     * Data user dikelola langsung di database production.
     */
    public function run(): void
    {
        // Database seeder tidak diperlukan
        // Tabel users sudah ada dengan data di database bersama
    }
}
