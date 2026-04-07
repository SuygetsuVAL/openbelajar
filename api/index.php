<?php
/**
 * Vercel serverless entry point for Laravel application
 * 
 * This file serves as the API route handler for all Vercel function requests.
 * Static files (HTML, CSS, JS) are served directly from public/ folder by Vercel.
 */

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Check if vendor directory exists - fail gracefully with info
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    http_response_code(503);
    header('Content-Type: application/json');
    die(json_encode(['error' => 'Service Unavailable: Vendor files not found.']));
}

// Bootstrap Laravel application
try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode(['error' => 'Failed to bootstrap application: ' . $e->getMessage()]));
}

// Create HTTP kernel and handle request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $response->send();
    
    $kernel->terminate($request, $response);
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode(['error' => 'Server Error: ' . $e->getMessage()]));
}
