<?php
require_once __DIR__ . '/config.php';
$defaultSocialImage = 'https://nds.studio/ai/assets/images/nds-ai-favicon.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PV94M6MB');</script>
<!-- End Google Tag Manager -->
 <meta name="google-site-verification" content="_cv32O4Os22TNjJ5_hEHqTq8bqgD6_c3ja16gR1QGj0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle ?? 'nDimensions.ai | AI Growth, Automation & Creative Systems') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'nDimensions.ai designs AI growth systems, automation, and creative production for modern B2B teams.') ?>">
    <meta name="theme-color" content="#0a0a0a">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle ?? $pageTitle ?? 'nDimensions.ai') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription ?? $metaDescription ?? 'nDimensions.ai is a growth and automation partner building AI-native systems for modern businesses.') ?>">
    <meta property="og:type" content="<?= htmlspecialchars($ogType ?? 'website') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl ?? url()) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage ?? $defaultSocialImage) ?>">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="<?= htmlspecialchars($twitterTitle ?? $pageTitle ?? 'nDimensions.ai') ?>">
    <meta property="twitter:description" content="<?= htmlspecialchars($twitterDescription ?? $metaDescription ?? 'nDimensions.ai builds AI growth systems and business automation.') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="twitter:image" content="<?= htmlspecialchars($twitterImage ?? $ogImage ?? $defaultSocialImage) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl ?? url()) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PV94M6MB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
