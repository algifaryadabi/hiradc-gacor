<?php

use App\Models\User;
use App\Models\Document;
use App\Models\Unit;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DEBUGGING ROUTING & DATA ===\n\n";

// 1. Check Units
echo "--- UNITS ---\n";
$units = Unit::all();
foreach ($units as $u) {
    if (str_contains(strtoupper($u->nama_unit), 'SECUR') || str_contains(strtoupper($u->nama_unit), 'KEAMANAN')) {
        echo "ID: {$u->id_unit} | Name: {$u->nama_unit}\n";
    }
}
echo "\n";

// 2. Check Approvers (Kepala Unit)
echo "--- APPROVERS (Kepala Unit) ---\n";
$approvers = User::where(function ($q) {
    $q->where('role_user', 'approver')
        ->orWhere('id_role_user', 3) // Assuming 3 is approver
        ->orWhere('role_jabatan', 'approver');
})->get();

foreach ($approvers as $a) {
    $unitName = $a->unit ? $a->unit->nama_unit : 'N/A';
    echo "ID: {$a->id_user} | Name: {$a->nama_user} | Role: {$a->role_user} | Unit ID: {$a->id_unit} ($unitName)\n";
}
echo "\n";

// 3. Check Recent Documents
echo "--- RECENT DOCUMENTS (Last 5) ---\n";
$docs = Document::latest()->take(5)->get();
foreach ($docs as $d) {
    $unitName = $d->unit ? $d->unit->nama_unit : 'N/A';
    echo "Doc ID: {$d->id_document} | Status: {$d->status} | Level: {$d->current_level} | Unit ID: {$d->id_unit} ($unitName) | User: {$d->user->nama_user}\n";
}
