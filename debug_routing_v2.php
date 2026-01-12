<?php

use App\Models\User;
use App\Models\Document;
use App\Models\Unit;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DEBUG OUTPUT ===\n";

// 1. Check Units
echo "\n[UNITS LIKE 'SECURITY']\n";
$units = Unit::where('nama_unit', 'LIKE', '%Security%')->orWhere('nama_unit', 'LIKE', '%Keamanan%')->get();
foreach ($units as $u) {
    echo "ID: $u->id_unit | $u->nama_unit\n";
}

// 2. Check Approvers
echo "\n[APPROVERS (Role Approver/Kepala Unit)]\n";
$approvers = User::where('role_user', 'approver')->get();
foreach ($approvers as $a) {
    echo "User: $a->nama_user (ID: $a->id_user) | UnitID: $a->id_unit\n";
}

// 3. Check Recent Documents
echo "\n[RECENT DOCUMENTS]\n";
$docs = Document::latest()->take(3)->get();
foreach ($docs as $d) {
    echo "Doc ID: $d->id (UnitID: $d->id_unit) | Status: $d->status | Level: $d->current_level\n";
}
