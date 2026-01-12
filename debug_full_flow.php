<?php
// debug_full_flow.php

use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "========== START DEBUGGING ==========\n";

// 1. FIND THE LATEST PENDING DOCUMENT
$doc = Document::where('status', 'like', 'pending%')->orderBy('created_at', 'desc')->first();

if (!$doc) {
    die("NO PENDING DOCUMENTS FOUND IN DB. SUBMIT ONE FIRST.\n");
}

echo "Target Document ID: {$doc->id_document}\n";
echo "Doc Unit ID: {$doc->id_unit}\n";
echo "Doc Level: {$doc->current_level}\n";
echo "Doc Status: {$doc->status}\n";

// 2. FIND PROPER APPROVER FOR THIS DOC
// Logic: Level 1 -> Same Unit.
$requiredUnit = $doc->id_unit;
echo "\nLooking for Approver in Unit ID: $requiredUnit\n";

$candidates = User::where('id_unit', $requiredUnit)->get();

echo "Found " . $candidates->count() . " users in this unit.\n";

$approverFound = false;
foreach ($candidates as $candidate) {
    echo " - User: {$candidate->nama_user} (RoleUser: '{$candidate->role_user}', RoleID: {$candidate->id_role_user})\n";

    // TEST MATCH LOGIC from DocumentController::pendingApproval
    $level = match ($candidate->role_user) {
        'approver' => 1,
        'unit_pengelola' => 2,
        'kepala_departemen' => 3,
        default => 0,
    };

    echo "   -> Calculated Level based on role_user: $level\n";

    if ($level == 1) {
        $approverFound = true;
        echo "   *** THIS USER SHOULD SEE THE DOC ***\n";

        // SIMULATE QUERY
        $visible = Document::where('current_level', 1)
            ->where('status', 'pending_level1')
            ->where('id_unit', $candidate->id_unit)
            ->where('id', $doc->id) // Specific check
            ->exists();

        echo "   -> Database Query Visibility Check: " . ($visible ? "VISIBLE" : "NOT VISIBLE") . "\n";
    }
}

if (!$approverFound) {
    echo "\nCRITICAL ISSUE: No user in Unit $requiredUnit has 'role_user' = 'approver'.\n";
    echo "Please check 'role_user' column in 'users' table. It might be null or have a different value (e.g. 'kepala_unit').\n";
}

echo "\n========== END DEBUGGING ==========\n";
