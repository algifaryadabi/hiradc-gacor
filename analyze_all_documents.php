<?php
/**
 * Database Analysis Script: Check All Documents
 * 
 * This script checks all documents to see which ones have missing details
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Document;
use App\Models\DocumentDetail;

echo "=== Analyzing All Documents ===\n\n";

// Get all documents
$documents = Document::orderBy('id', 'desc')->take(20)->get();

echo "Checking last 20 documents:\n\n";

$withDetails = 0;
$withoutDetails = 0;
$problematic = [];

foreach ($documents as $doc) {
    $detailsCount = DocumentDetail::where('document_id', $doc->id)->count();
    
    if ($detailsCount > 0) {
        $withDetails++;
        echo "✅ Doc #{$doc->id} - {$doc->judul_dokumen} - {$detailsCount} details\n";
    } else {
        $withoutDetails++;
        $problematic[] = $doc->id;
        echo "❌ Doc #{$doc->id} - {$doc->judul_dokumen} - NO DETAILS!\n";
    }
}

echo "\n=== Summary ===\n";
echo "Documents with details: {$withDetails}\n";
echo "Documents without details: {$withoutDetails}\n";

if (count($problematic) > 0) {
    echo "\n⚠️  Problematic document IDs: " . implode(', ', $problematic) . "\n";
    echo "\nThese documents have NO entries in document_details table!\n";
    echo "This could mean:\n";
    echo "1. Data was accidentally deleted\n";
    echo "2. Migration issue\n";
    echo "3. Form submission bug\n";
}

// Check if there's a pattern
echo "\n=== Checking Document Details Table ===\n";
$totalDetails = DocumentDetail::count();
$totalDocuments = Document::count();

echo "Total documents in database: {$totalDocuments}\n";
echo "Total detail records: {$totalDetails}\n";
echo "Average details per document: " . round($totalDetails / max($totalDocuments, 1), 2) . "\n";

// Check recent deletions (if soft deletes enabled)
echo "\n=== Checking for Recent Changes ===\n";
$recentDetails = DocumentDetail::orderBy('updated_at', 'desc')->take(5)->get();

echo "Last 5 updated detail records:\n";
foreach ($recentDetails as $detail) {
    echo "  - Detail #{$detail->id} (Doc #{$detail->document_id}) - Updated: {$detail->updated_at}\n";
}

echo "\n=== Analysis Complete ===\n";
