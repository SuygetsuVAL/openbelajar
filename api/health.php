<?php
/**
 * Health check endpoint for Vercel monitoring
 */

header('Content-Type: application/json');

$health = [
    'status' => 'ok',
    'timestamp' => date('Y-m-d H:i:s'),
    'environment' => app()->environment(),
];

echo json_encode($health);
