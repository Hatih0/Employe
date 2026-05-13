<?php
// Router for PHP Built-in Server
// Usage: php -S localhost:8080 router.php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files
if ($uri !== '/' && file_exists('public' . $uri)) {
    return false; // Let PHP serve the file
}

// Route everything else to public/index.php
require_once __DIR__ . '/public/index.php';
