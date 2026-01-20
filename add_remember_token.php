<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Cek apakah kolom remember_token sudah ada
$hasColumn = Schema::hasColumn('users', 'remember_token');

if ($hasColumn) {
    echo "✓ Kolom 'remember_token' sudah ada di tabel users\n";
} else {
    echo "✗ Kolom 'remember_token' belum ada di tabel users\n";
    echo "Menambahkan kolom remember_token...\n";
    
    try {
        // Tambahkan kolom remember_token
        DB::statement('ALTER TABLE users ADD COLUMN remember_token VARCHAR(100) NULL AFTER password');
        echo "✓ Kolom 'remember_token' berhasil ditambahkan!\n";
    } catch (Exception $e) {
        echo "✗ Error: " . $e->getMessage() . "\n";
    }
}

// Tampilkan struktur tabel users
echo "\n=== Struktur Tabel Users ===\n";
$columns = DB::select('DESCRIBE users');
foreach ($columns as $column) {
    echo "{$column->Field} ({$column->Type}) - {$column->Null} - {$column->Key}\n";
}
