<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Document;

// Try to find a user with documents
$docs = Document::take(1)->first();
if (!$docs) {
    echo "No documents found in DB\n";
    exit;
}
$unitId = $docs->id_unit;
echo "Testing with Unit ID: $unitId from Doc ID: {$docs->id}\n";

$query = Document::where('id_unit', $unitId);
$total = $query->count();
echo "Total Docs (Unit): $total\n";

$drafts = Document::where('id_unit', $unitId)->where('status', 'draft')->get();
echo "Drafts (Total): " . $drafts->count() . "\n";
foreach ($drafts as $d) {
    echo " - ID: {$d->id}, Created: {$d->created_at}, Year: " . ($d->created_at ? $d->created_at->format('Y') : 'null') . "\n";
}

// Check filtering logic
$year = 2026;
$filteredQuery = Document::where('id_unit', $unitId)->whereYear('created_at', $year);
echo "Docs in $year: " . $filteredQuery->count() . "\n";
echo "Drafts in $year: " . $filteredQuery->where('status', 'draft')->count() . "\n";

$year = 2025;
$filteredQuery = Document::where('id_unit', $unitId)->whereYear('created_at', $year);
echo "Docs in $year: " . $filteredQuery->count() . "\n";
echo "Drafts in $year: " . $filteredQuery->where('status', 'draft')->count() . "\n";
