<?php
require_once __DIR__ . '/config.php';

function database()
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}

function ensureDatabaseSchema()
{
    $pdo = database();

    $pdo->exec("CREATE TABLE IF NOT EXISTS leads (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        email VARCHAR(190) NOT NULL,
        company VARCHAR(190) NULL,
        phone VARCHAR(60) NULL,
        system_interest VARCHAR(80) NULL,
        timeline VARCHAR(80) NULL,
        challenge TEXT NOT NULL,
        status VARCHAR(30) NOT NULL DEFAULT 'new',
        notes TEXT NULL,
        first_utm_source VARCHAR(255) NULL,
        first_utm_medium VARCHAR(255) NULL,
        first_utm_campaign VARCHAR(255) NULL,
        first_utm_term VARCHAR(255) NULL,
        first_utm_content VARCHAR(255) NULL,
        first_gclid VARCHAR(255) NULL,
        first_fbclid VARCHAR(255) NULL,
        first_landing_page VARCHAR(2048) NULL,
        first_referrer VARCHAR(2048) NULL,
        last_utm_source VARCHAR(255) NULL,
        last_utm_medium VARCHAR(255) NULL,
        last_utm_campaign VARCHAR(255) NULL,
        last_utm_term VARCHAR(255) NULL,
        last_utm_content VARCHAR(255) NULL,
        last_gclid VARCHAR(255) NULL,
        last_fbclid VARCHAR(255) NULL,
        last_landing_page VARCHAR(2048) NULL,
        last_referrer VARCHAR(2048) NULL,
        ip_address VARCHAR(45) NULL,
        user_agent VARCHAR(512) NULL,
        email_sent TINYINT(1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_leads_status_created (status, created_at),
        INDEX idx_leads_email (email),
        INDEX idx_leads_source (first_utm_source)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS admin_users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(80) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        last_login_at TIMESTAMP NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
}

function createLead(array $lead)
{
    ensureDatabaseSchema();
    $columns = [
        'name', 'email', 'company', 'phone', 'system_interest', 'timeline', 'challenge',
        'first_utm_source', 'first_utm_medium', 'first_utm_campaign', 'first_utm_term', 'first_utm_content',
        'first_gclid', 'first_fbclid', 'first_landing_page', 'first_referrer',
        'last_utm_source', 'last_utm_medium', 'last_utm_campaign', 'last_utm_term', 'last_utm_content',
        'last_gclid', 'last_fbclid', 'last_landing_page', 'last_referrer',
        'ip_address', 'user_agent'
    ];
    $placeholders = array_map(function ($column) { return ':' . $column; }, $columns);
    $statement = database()->prepare(
        'INSERT INTO leads (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $placeholders) . ')'
    );
    $params = [];
    foreach ($columns as $column) {
        $params[$column] = ($lead[$column] ?? '') !== '' ? $lead[$column] : null;
    }
    $statement->execute($params);

    return (int) database()->lastInsertId();
}

function markLeadEmailSent($leadId, $sent)
{
    $statement = database()->prepare('UPDATE leads SET email_sent = :sent WHERE id = :id');
    $statement->execute(['sent' => $sent ? 1 : 0, 'id' => (int) $leadId]);
}
?>
