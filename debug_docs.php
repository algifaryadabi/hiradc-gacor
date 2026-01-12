<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== RECENT DOCUMENTS ===\n";
$docs = DB::table('documents')
    ->orderBy('id_document', 'desc')
    ->limit(3)
    ->get(['id_document', 'id_user', 'id_unit', 'status', 'current_level', 'kategori', 'created_at']);

foreach ($docs as $doc) {
    echo sprintf(
        "ID: %d | User: %d | Unit: %d | Status: %s | Level: %d | Kategori: %s | Created: %s\n",
        $doc->id_document,
        $doc->id_user,
        $doc->id_unit,
        $doc->status,
        $doc->current_level,
        $doc->kategori,
        $doc->created_at
    );
}

echo "\n=== USER INFO (Senior Manager Security) ===\n";
$users = DB::table('ms_users')
    ->where('nama_user', 'like', '%senior%')
    ->orWhere('nama_user', 'like', '%manager%')
    ->get(['id_user', 'nama_user', 'id_unit', 'role_user', 'id_role_user', 'role_jabatan', 'id_role_jabatan']);

foreach ($users as $user) {
    echo sprintf(
        "ID: %d | Name: %s | Unit: %d | role_user: %s | id_role_user: %s | role_jabatan: %s\n",
        $user->id_user,
        $user->nama_user,
        $user->id_unit ?? 0,
        $user->role_user ?? 'null',
        $user->id_role_user ?? 'null',
        $user->role_jabatan ?? 'null'
    );
}
