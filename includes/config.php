<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

function asset($path)
{
    return BASE_URL . 'assets/' . ltrim($path, '/');
}

function url($path = '')
{
    return BASE_URL . ltrim($path, '/');
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
