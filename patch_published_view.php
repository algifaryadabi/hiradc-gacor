<?php

$targetFile = 'd:\AAA\hiradc-gacor\resources\views\documents\published_detail.blade.php';
$patchFile = 'd:\AAA\hiradc-gacor\puk_patch_published.blade.php';

if (!file_exists($targetFile)) {
    die("Target file not found: $targetFile\n");
}

if (!file_exists($patchFile)) {
    die("Patch file not found: $patchFile\n");
}

$content = file_get_contents($targetFile);
$patch = file_get_contents($patchFile);

$marker = '<!-- Approval History -->';
$pos = strpos($content, $marker);

if ($pos === false) {
    die("Error: Could not find marker '$marker' in target file.\n");
}

// Check if already patched
if (strpos($content, '<!-- PROGRESS PROGRAM TABLES (PUK & PMK) - INSERTED VIA PATCH -->') !== false) {
    die("File already patched.\n");
}

// Insert before marker
$newContent = substr_replace($content, $patch . "\n\n            ", $pos, 0);

file_put_contents($targetFile, $newContent);

echo "Successfully patched published_detail.blade.php\n";
