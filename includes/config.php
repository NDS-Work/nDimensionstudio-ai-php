<?php
if (!defined('BASE_URL')) {
    $scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $basePath = $scriptDirectory === '/' || $scriptDirectory === '.' ? '' : rtrim($scriptDirectory, '/');

    define('BASE_URL', $basePath . '/');
}

function asset($path)
{
    return BASE_URL . 'assets/' . ltrim($path, '/');
}

function url($path = '')
{
    $path = ltrim($path, '/');

    if (PHP_SAPI !== 'cli-server') {
        $path = preg_replace('/^index\.php(?=($|[?#]))/i', '', $path);
        $path = preg_replace('/\.php(?=($|[?#]))/i', '', $path);
    }

    return BASE_URL . $path;
}

function activeClass($page, $current)
{
    return $page === $current ? 'active' : '';
}

function pageTitle($title)
{
    return $title . ' | nDimensions.ai';
}
?>
