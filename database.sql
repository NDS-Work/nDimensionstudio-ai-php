CREATE DATABASE IF NOT EXISTS ndsai CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ndsai;

CREATE TABLE IF NOT EXISTS leads (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS admin_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_login_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
