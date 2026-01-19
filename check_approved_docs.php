<?php
use App\Models\Document;
use App\Models\DocumentDetail;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$approvedDocs = Document::where('status', 'approved')->orWhere('status', 'published')->get();

echo "Approved/Published Documents: " . $approvedDocs->count() . "\n";

foreach ($approvedDocs as $doc) {
    if (!$doc->relationLoaded('details')) {
        $doc->load('details');
    }
    echo "Doc ID: " . $doc->id . " - Status: " . $doc->status . " - Details Count: " . $doc->details->count() . "\n";
}

$pendingDocs = Document::where('status', 'like', 'pending_%')->get();
echo "\nPending Documents: " . $pendingDocs->count() . "\n";
foreach ($pendingDocs as $doc) {
    echo "Doc ID: " . $doc->id . " - Status: " . $doc->status . " - Details Count: " . $doc->details->count() . "\n";
}
