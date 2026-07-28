<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle ?? 'nDimensions.ai | AI Growth, Automation & Creative Systems') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'nDimensions.ai designs AI growth systems, automation, and creative production for modern B2B teams.') ?>">
    <meta name="theme-color" content="#0a0a0a">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle ?? $pageTitle ?? 'nDimensions.ai') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription ?? $metaDescription ?? 'nDimensions.ai is a growth and automation partner building AI-native systems for modern businesses.') ?>">
    <meta property="og:type" content="<?= htmlspecialchars($ogType ?? 'website') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl ?? url()) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage ?? 'https://images.unsplash.com/photo-1531891437562-4301cf35b7e4?crop=entropy&fm=jpg&q=85&w=1200') ?>">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="<?= htmlspecialchars($twitterTitle ?? $pageTitle ?? 'nDimensions.ai') ?>">
    <meta property="twitter:description" content="<?= htmlspecialchars($twitterDescription ?? $metaDescription ?? 'nDimensions.ai builds AI growth systems and business automation.') ?>">
    <meta property="twitter:image" content="<?= htmlspecialchars($twitterImage ?? $ogImage ?? 'https://images.unsplash.com/photo-1531891437562-4301cf35b7e4?crop=entropy&fm=jpg&q=85&w=1200') ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl ?? url()) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body>
