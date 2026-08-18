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

// Some local XAMPP installs expose a session directory PHP cannot write to.
if (session_status() === PHP_SESSION_NONE) {
    $configuredSessionPath = session_save_path();
    if ($configuredSessionPath === '' || !is_dir($configuredSessionPath) || !is_writable($configuredSessionPath)) {
        $fallbackSessionPath = dirname(__DIR__) . '/storage/sessions';
        if (!is_dir($fallbackSessionPath)) {
            mkdir($fallbackSessionPath, 0700, true);
        }
        session_save_path($fallbackSessionPath);
    }
}

if (!defined('BASE_URL')) {
    $scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    if (basename($scriptDirectory) === 'admin') {
        $scriptDirectory = str_replace('\\', '/', dirname($scriptDirectory));
    }
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

    $path = preg_replace('/^index\.php(?=($|[?#]))/i', '', $path);
    $path = preg_replace('/\.php(?=($|[?#]))/i', '', $path);

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

// MySQL settings. Override these values in .env on production.
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'ndsai');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '');

function captureAttribution()
{
    if (PHP_SAPI === 'cli' || strpos($_SERVER['SCRIPT_NAME'] ?? '', '/admin/') !== false) {
        return;
    }

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid'];
    $touch = [];
    $hasCampaignData = false;

    foreach ($keys as $key) {
        $value = trim((string) ($_GET[$key] ?? ''));
        $value = substr($value, 0, 255);
        $touch[$key] = $value;
        if ($value !== '') {
            $hasCampaignData = true;
        }
    }

    $touch['landing_page'] = substr((string) ($_SERVER['REQUEST_URI'] ?? ''), 0, 2048);
    $touch['referrer'] = substr((string) ($_SERVER['HTTP_REFERER'] ?? ''), 0, 2048);
    $touch['captured_at'] = date('c');

    $firstTouch = $_SESSION['nds_attribution_first'] ?? [];
    $firstHasCampaignData = false;
    foreach ($keys as $key) {
        if (!empty($firstTouch[$key])) {
            $firstHasCampaignData = true;
            break;
        }
    }

    // Treat the first identifiable campaign as acquisition when the session
    // initially began as a direct visit.
    if (empty($firstTouch) || (!$firstHasCampaignData && $hasCampaignData)) {
        $_SESSION['nds_attribution_first'] = $touch;
    }

    if (empty($_SESSION['nds_attribution_last']) || $hasCampaignData) {
        $_SESSION['nds_attribution_last'] = $touch;
    }
}

function attributionData()
{
    $first = $_SESSION['nds_attribution_first'] ?? [];
    $last = $_SESSION['nds_attribution_last'] ?? $first;
    $data = [];

    foreach (['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid', 'landing_page', 'referrer'] as $key) {
        $data['first_' . $key] = (string) ($first[$key] ?? '');
        $data['last_' . $key] = (string) ($last[$key] ?? '');
    }

    return $data;
}

captureAttribution();

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

    // Handle multiple recipients separated by commas
    $recipients = [];
    $emailList = explode(',', $toEmail);
    foreach ($emailList as $email) {
        $trimmedEmail = trim($email);
        if (filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
            $recipients[] = ['email' => $trimmedEmail];
        }
    }

    if (empty($recipients)) {
        return false;
    }

    $data = [
        'sender' => [
            'name' => $senderName,
            'email' => $senderEmail
        ],
        'to' => $recipients,
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
