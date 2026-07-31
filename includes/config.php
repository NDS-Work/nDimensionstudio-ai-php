<?php
// Load environment variables from .env file
$envPath = dirname(__DIR__) . '/.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            // Strip quotes if present
            if (preg_match('/^([\'"])(.*)\1$/', $value, $matches)) {
                $value = $matches[2];
            }
            if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
                putenv("{$key}={$value}");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
}

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

// Brevo API settings loaded from env
define('BREVO_API_KEY', getenv('BREVO_API_KEY') ?: 'xkeysib-YOUR-BREVO-API-KEY');
define('BREVO_SENDER_EMAIL', getenv('BREVO_SENDER_EMAIL') ?: 'website@ndimensions.ai');
define('BREVO_SENDER_NAME', getenv('BREVO_SENDER_NAME') ?: 'nDimensions Website');
define('BREVO_RECIPIENT_EMAIL', getenv('BREVO_RECIPIENT_EMAIL') ?: 'hello@ndimensions.ai');

/**
 * Sends a transactional email using Brevo's HTTP API.
 */
function sendEmailViaBrevo($toEmail, $subject, $textContent, $replyToEmail = null, $replyToName = null)
{
    $apiKey = defined('BREVO_API_KEY') ? BREVO_API_KEY : '';
    $senderEmail = defined('BREVO_SENDER_EMAIL') ? BREVO_SENDER_EMAIL : '';
    $senderName = defined('BREVO_SENDER_NAME') ? BREVO_SENDER_NAME : '';

    if (empty($apiKey) || strpos($apiKey, 'YOUR-BREVO-API-KEY') !== false || empty($senderEmail)) {
        // Fallback error logging or handling can go here
        return false;
    }

    $data = [
        'sender' => [
            'name' => $senderName,
            'email' => $senderEmail
        ],
        'to' => [
            [
                'email' => $toEmail
            ]
        ],
        'subject' => $subject,
        'textContent' => $textContent
    ];

    if ($replyToEmail) {
        $data['replyTo'] = [
            'email' => $replyToEmail,
            'name' => $replyToName ?: $replyToEmail
        ];
    }

    $ch = curl_init('https://api.brevo.com/v3/smtp/email');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'accept: application/json',
        'api-key: ' . $apiKey,
        'content-type: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($httpCode === 201 || $httpCode === 200);
}
?>
