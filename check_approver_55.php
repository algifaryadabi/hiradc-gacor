<?php
use App\Models\User;
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$approvers = User::where('id_unit', 55)
    ->where(function ($q) {
        $q->where('role_user', 'approver')
            ->orWhere('id_role_user', 3)
            ->orWhere('role_jabatan', 'approver');
    })->get();

if ($approvers->count() == 0) {
    echo "NO APPROVER FOUND for Unit 55 (Security).\n";
    // Suggest a user to update?
    $potential = User::where('id_unit', 55)->get();
    echo "Users in Unit 55: " . $potential->count() . "\n";
    foreach ($potential as $p)
        echo "- " . $p->nama_user . " (" . $p->role_user . ")\n";
} else {
    echo "FOUND APPROVER for Unit 55:\n";
    foreach ($approvers as $a)
        echo "- " . $a->nama_user . " (" . $a->username . ")\n";
}
