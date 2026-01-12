<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ROLE JABATAN DATA ===\n";
$roles = DB::table('role_jabatan')->get();
foreach ($roles as $role) {
    echo "ID: {$role->id_role_jabatan} | Nama: {$role->nama_role_jabatan}\n";
}

echo "\n=== USERS WITH ROLE JABATAN (ALL) ===\n";
$allUsers = DB::table('users')
    ->select('id_user', 'username', 'nama_user', 'role_jabatan', 'id_role_jabatan', 'id_role_user', 'id_unit')
    ->whereNotNull('role_jabatan')
    ->limit(20)
    ->get();

foreach ($allUsers as $user) {
    $roleJab = $user->role_jabatan ?? $user->id_role_jabatan ?? 'null';
    echo "User: {$user->username} | Role Jabatan: {$roleJab} | Role User: {$user->id_role_user} | Unit: {$user->id_unit}\n";
}

echo "\n=== ALL UNITS ===\n";
$units = DB::table('units')->select('id_unit', 'nama_unit')->get();
foreach ($units as $unit) {
    echo "ID: {$unit->id_unit} | Nama: {$unit->nama_unit}\n";
}
