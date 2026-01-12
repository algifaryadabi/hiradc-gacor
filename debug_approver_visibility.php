<?php
use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// SIMULATE LOGIN AS THE APPROVER
// We need to find the Senior Manager user first.
// Let's assume Unit 55 since that was the previous context.
$approver = User::where('id_unit', 55)
    ->where(function ($q) {
        $q->where('role_user', 'approver')
            ->orWhere('id_role_user', 3);
    })->first();

if (!$approver) {
    echo "CRITICAL: No Approver found for Unit 55 to test with.\n";
    // Try to find ANY approver to test logic
    $approver = User::where('role_user', 'approver')->first();
    echo "Falling back to Approver: {$approver->nama_user} (Unit: {$approver->id_unit})\n";
} else {
    echo "Testing with Approver: {$approver->nama_user} (ID: {$approver->id_user}, Unit: {$approver->id_unit})\n";
}

Auth::login($approver);
$user = Auth::user();

// REPLICATE DocumentController@pendingApproval LOGIC
$level = 1; // Approver is Level 1

echo "\n--- LOGIC TRACE ---\n";
echo "Role: {$user->role_user}\n";
echo "Level: $level\n";
echo "Filtering: current_level=$level, status=pending_level$level, id_unit={$user->id_unit}\n";

$query = Document::where('current_level', $level)
    ->where('status', 'pending_level' . $level);

// Check Count BEFORE Unit Filter
$countGlobal = $query->count();
echo "Global Pending Level 1 Docs: $countGlobal\n";

// Apply Unit Filter
$query->where('id_unit', $user->id_unit);

$countScoped = $query->count();
echo "Scoped (Unit {$user->id_unit}) Docs: $countScoped\n";

$docs = $query->get();
if ($docs->isEmpty()) {
    echo "Result: NO DOCUMENTS FOUND in list.\n";

    // DEBUG: Show why. Are there docs in this unit pending?
    $unitDocs = Document::where('id_unit', $user->id_unit)->where('status', 'pending_level1')->count();
    echo "DEBUG: Actual DB count for Unit {$user->id_unit} + PendingLvl1: $unitDocs\n";

    if ($unitDocs > 0) {
        echo "MISMATCH: Logic is filtering them out differently than the direct DB query?\n";
        echo "Check current_level mismatch? \n";
        $mismatch = Document::where('id_unit', $user->id_unit)->where('status', 'pending_level1')->first();
        echo "Sample Doc: Level={$mismatch->current_level}, Status={$mismatch->status}\n";
    }
} else {
    echo "Result: Found {$docs->count()} documents.\n";
    foreach ($docs as $d)
        echo "- Doc {$d->id_document}: {$d->kolom2_kegiatan}\n";
}
