<?php
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating master data tables...\n";
    
    // 1. Master Matriks Risiko
    DB::statement("
        CREATE TABLE IF NOT EXISTS master_matriks_risiko (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            kemungkinan INT NOT NULL,
            konsekuensi INT NOT NULL,
            score INT NOT NULL,
            level VARCHAR(255) NOT NULL,
            warna VARCHAR(255),
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL,
            UNIQUE KEY unique_matrix (kemungkinan, konsekuensi)
        ) ENGINE=InnoDB;
    ");
    echo "✓ master_matriks_risiko created\n";

    // 2. Master Kemungkinan
    DB::statement("
        CREATE TABLE IF NOT EXISTS master_kemungkinan (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            nama VARCHAR(255) NOT NULL,
            deskripsi TEXT NOT NULL,
            frekuensi VARCHAR(255),
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    echo "✓ master_kemungkinan created\n";

    // 3. Master Konsekuensi K3
    DB::statement("
        CREATE TABLE IF NOT EXISTS master_konsekuensi_k3 (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            nama VARCHAR(255) NOT NULL,
            deskripsi TEXT NOT NULL,
            dampak TEXT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    echo "✓ master_konsekuensi_k3 created\n";

    // 4. Master Konsekuensi Lingkungan
    DB::statement("
        CREATE TABLE IF NOT EXISTS master_konsekuensi_lingkungan (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            nama VARCHAR(255) NOT NULL,
            deskripsi TEXT NOT NULL,
            dampak TEXT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    echo "✓ master_konsekuensi_lingkungan created\n";

    // 5. Master Konsekuensi Keamanan
    DB::statement("
        CREATE TABLE IF NOT EXISTS master_konsekuensi_keamanan (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            nama VARCHAR(255) NOT NULL,
            deskripsi TEXT NOT NULL,
            dampak TEXT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    echo "✓ master_konsekuensi_keamanan created\n";

    echo "\nAll tables created successfully!\n";
    echo "Now run: php run_master_seeder.php\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
