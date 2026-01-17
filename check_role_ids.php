<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$roles = App\Models\RoleJabatan::all();
foreach ($roles as $r) {
    echo "ID: " . $r->id_role_jabatan . " | Name: " . $r->nama_role_jabatan . "\n";
}
