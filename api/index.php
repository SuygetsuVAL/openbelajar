<?php
// Entry point for Vercel serverless functions

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$request = \Illuminate\Http\Request::capture();

$response = $app->handleRequest($request);

$response->send();
