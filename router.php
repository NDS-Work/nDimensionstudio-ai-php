<?php
$requestPath = rawurldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$normalizedPath = '/' . ltrim(str_replace('\\', '/', $requestPath), '/');

// Match the Apache protections while using PHP's development server.
if (
    strpos($normalizedPath, "\0") !== false
    || strpos($normalizedPath, '..') !== false
    || preg_match('#/(?:\.env(?:\.|$)|storage(?:/|$))#i', $normalizedPath)
    || preg_match('/\.(?:sql|log)$/i', $normalizedPath)
) {
    http_response_code(404);
    exit('Not found');
}

// Keep direct PHP requests canonical during local development too.
if (preg_match('/\.php$/i', $normalizedPath)) {
    $target = $normalizedPath === '/index.php'
        ? '/'
        : preg_replace('/\.php$/i', '', $normalizedPath);
    $query = $_SERVER['QUERY_STRING'] ?? '';
    header('Location: ' . $target . ($query !== '' ? '?' . $query : ''), true, 301);
    exit;
}

$requestedFile = __DIR__ . $normalizedPath;
if ($normalizedPath === '/' || is_file($requestedFile) || is_dir($requestedFile)) {
    return false;
}

$route = trim($normalizedPath, '/');
if ($route !== '' && preg_match('#^[A-Za-z0-9/_-]+$#', $route)) {
    $phpFile = __DIR__ . '/' . $route . '.php';
    if (is_file($phpFile)) {
        require $phpFile;
        return true;
    }
}

http_response_code(404);
header('Content-Type: text/html; charset=utf-8');
echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Page not found</title></head><body><main><h1>Page not found</h1><p><a href="/">Return home</a></p></main></body></html>';
return true;
