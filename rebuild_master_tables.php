<?php
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "🗑️  Dropping old master data tables...\n";
    
    DB::statement("DROP TABLE IF EXISTS master_konsekuensi_keamanan");
    DB::statement("DROP TABLE IF EXISTS master_konsekuensi_lingkungan");
    DB::statement("DROP TABLE IF EXISTS master_konsekuensi_k3");
    DB::statement("DROP TABLE IF EXISTS master_kemungkinan");
    DB::statement("DROP TABLE IF EXISTS master_matriks_risiko");
    
    echo "✅ Old tables dropped\n\n";
    
    echo "📊 Creating new master data tables...\n\n";
    
    // 1. Master Matriks Risiko
    echo "Creating master_matriks_risiko...\n";
    DB::statement("
        CREATE TABLE master_matriks_risiko (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            kemungkinan INT NOT NULL,
            konsekuensi INT NOT NULL,
            score INT NOT NULL,
            level VARCHAR(255) NOT NULL,
            warna VARCHAR(255),
            program_mitigasi TEXT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL,
            UNIQUE KEY unique_matrix (kemungkinan, konsekuensi)
        ) ENGINE=InnoDB;
    ");
    
    // 2. Master Kemungkinan
    echo "Creating master_kemungkinan...\n";
    DB::statement("
        CREATE TABLE master_kemungkinan (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            nama VARCHAR(255) NOT NULL,
            penjelasan TEXT NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    
    // 3. Master Konsekuensi K3/KO (7 kolom)
    echo "Creating master_konsekuensi_k3...\n";
    DB::statement("
        CREATE TABLE master_konsekuensi_k3 (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            konsekuensi_manusia TEXT,
            financial VARCHAR(255),
            objective TEXT,
            legal TEXT,
            biaya_program_mitigasi VARCHAR(255),
            reputasi TEXT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    
    // 4. Master Konsekuensi Lingkungan (12 kolom)
    echo "Creating master_konsekuensi_lingkungan...\n";
    DB::statement("
        CREATE TABLE master_konsekuensi_lingkungan (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            cakupan_lokasi VARCHAR(255),
            lama_pemulihan VARCHAR(255),
            lama_penyimpangan VARCHAR(255),
            financial VARCHAR(255),
            objective TEXT,
            legal TEXT,
            product_image VARCHAR(255),
            konsekuensi_manusia TEXT,
            dampak_sosial TEXT,
            biaya_perbaikan VARCHAR(255),
            reputasi TEXT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    
    // 5. Master Konsekuensi Keamanan (6 kolom)
    echo "Creating master_konsekuensi_keamanan...\n";
    DB::statement("
        CREATE TABLE master_konsekuensi_keamanan (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            level INT NOT NULL UNIQUE,
            konsekuensi_manusia VARCHAR(255),
            financial VARCHAR(255),
            objective TEXT,
            legal TEXT,
            biaya_program_mitigasi VARCHAR(255),
            reputasi TEXT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB;
    ");
    
    echo "\n✅ All new tables created successfully!\n";
    echo "Next: Run php seed_official_data.php\n";

} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
