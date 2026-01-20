<?php

// Test AJAX endpoint
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

echo "=== Testing AJAX Endpoint ===\n\n";

// Simulate AJAX request
$request = Illuminate\Http\Request::create('/admin/users', 'GET', [], [], [], [
    'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
    'HTTP_ACCEPT' => 'application/json'
]);

try {
    $response = $kernel->handle($request);
    
    echo "Status Code: " . $response->getStatusCode() . "\n";
    echo "Content-Type: " . $response->headers->get('Content-Type') . "\n\n";
    
    $content = $response->getContent();
    
    if ($response->getStatusCode() === 200) {
        $data = json_decode($content, true);
        
        if (is_array($data)) {
            echo "Total users returned: " . count($data) . "\n\n";
            
            if (count($data) > 0) {
                echo "First user sample:\n";
                echo json_encode($data[0], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                echo "\n\n=== SUCCESS ===\n";
            } else {
                echo "WARNING: No users returned!\n";
            }
        } else {
            echo "ERROR: Response is not an array\n";
            echo "Response: " . substr($content, 0, 500) . "\n";
        }
    } else {
        echo "ERROR: HTTP " . $response->getStatusCode() . "\n";
        echo "Response: " . substr($content, 0, 500) . "\n";
    }
    
} catch (\Exception $e) {
    echo "\n=== ERROR ===\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

$kernel->terminate($request, $response);
