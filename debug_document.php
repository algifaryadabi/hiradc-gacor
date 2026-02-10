<?php
/**
 * Debug Script: Check Document Details
 * 
 * This script helps debug why HIRADC table data is not showing for a specific document
 * 
 * Usage: php debug_document.php [document_id]
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Document;
use App\Models\DocumentDetail;

// Get document ID from command line argument
$documentId = $argv[1] ?? null;

if (!$documentId) {
    echo "Usage: php debug_document.php [document_id]\n";
    echo "Example: php debug_document.php 45\n";
    exit(1);
}

echo "=== Debugging Document ID: {$documentId} ===\n\n";

// 1. Check if document exists
$document = Document::find($documentId);
if (!$document) {
    echo "❌ Document not found!\n";
    exit(1);
}

echo "✅ Document found\n";
echo "   - Judul: {$document->judul_dokumen}\n";
echo "   - Status: {$document->status}\n";
echo "   - Kategori: {$document->kategori}\n";
echo "   - Created: {$document->created_at}\n\n";

// 2. Check document details
echo "=== Checking Document Details ===\n";
$details = DocumentDetail::where('document_id', $documentId)->get();

if ($details->count() == 0) {
    echo "❌ No document details found! This is the problem!\n";
    echo "   The document has no entries in document_details table.\n\n";
    
    echo "💡 Possible solutions:\n";
    echo "   1. Re-submit the document from the form\n";
    echo "   2. Check if data was accidentally deleted\n";
    echo "   3. Check database migration/seeding\n";
} else {
    echo "✅ Found {$details->count()} detail records\n\n";
    
    foreach ($details as $index => $detail) {
        $detailNum = $index + 1;
        echo "Detail #{$detailNum}:\n";
        echo "   - ID: {$detail->id}\n";
        echo "   - Kategori: {$detail->kategori}\n";
        echo "   - Proses: {$detail->kolom2_proses}\n";
        echo "   - Kegiatan: {$detail->kolom2_kegiatan}\n";
        echo "   - Lokasi: {$detail->kolom3_lokasi}\n";
        echo "   - Bahaya: " . (is_array($detail->kolom6_bahaya) ? count($detail->kolom6_bahaya) . " items" : "null") . "\n";
        echo "   - Dampak: {$detail->kolom7_dampak}\n";
        echo "   - Risiko: {$detail->kolom9_risiko}\n";
        echo "   - Score: {$detail->kolom14_score}\n";
        echo "   - Level: {$detail->kolom14_level}\n";
        echo "\n";
    }
}

// 3. Check if document has PMK/PUK
echo "=== Checking Program Kerja ===\n";
$pmk = $document->pmkProgram;
$puk = $document->pukProgram;

if ($pmk) {
    echo "✅ Has PMK Program\n";
    echo "   - Judul: {$pmk->judul}\n";
} else {
    echo "ℹ️  No PMK Program\n";
}

if ($puk) {
    echo "✅ Has PUK Program\n";
    echo "   - Judul: {$puk->judul}\n";
} else {
    echo "ℹ️  No PUK Program\n";
}

echo "\n=== Debug Complete ===\n";
