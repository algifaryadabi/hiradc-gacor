<?php

use App\Models\PmkProgram;
use App\Models\Document;
use App\Models\DocumentDetail;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get the latest PMK Program
$pmk = PmkProgram::latest()->first();

if ($pmk) {
    echo "PMK ID: " . $pmk->id . "\n";
    $detail = DocumentDetail::find($pmk->document_detail_id);
    if (!$detail) {
        die("Detail not found\n");
    }
    $doc = Document::find($detail->document_id);
    if (!$doc) {
        die("Document not found\n");
    }
    $user = User::find($doc->id_user);

    echo "Created By: " . ($user->nama_user ?? 'Unknown') . " (ID: " . $user->id_user . ", Unit: " . $user->id_unit . ")\n";
    
    // Check available Managers (Role 3) in this unit
    $managers = User::where('id_unit', $user->id_unit)
                ->where('role_jabatan', 3)
                ->get();
    
    echo "Available Managers (Role 3) for Unit " . $user->id_unit . ": " . $managers->count() . "\n";
    if ($managers->count() > 0) {
        foreach($managers as $m) {
            echo "- " . $m->nama_user . " (Value: '" . $m->nama_user . "')\n";
        }
    } else {
        echo "WARNING: No managers found for this unit! Dropdown will be empty.\n";
    }

    echo "Program Kerja (Raw JSON):\n";
    print_r($pmk->program_kerja);
} else {
    echo "No PMK Program found.\n";
}
