<?php
$comingSoonProducts = [
    'cre8lab' => [
        'name' => 'Cre8LAB',
        'accent' => '#9333ea',
    ],
];

$productKey = strtolower(trim($_GET['product'] ?? 'cre8lab'));
$product = $comingSoonProducts[$productKey] ?? $comingSoonProducts['cre8lab'];

$activePage = $productKey;
$pageTitle = $product['name'] . ' | Coming Soon';
$metaDescription = $product['name'] . ' is coming soon from nDimensions.ai.';
$ogTitle = $pageTitle . ' | nDimensions.ai';
$ogDescription = $metaDescription;
$canonicalUrl = 'https://ndimensions.ai/ai/coming-soon?product=' . rawurlencode($productKey);

require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>

<main class="simple-coming-soon" style="--coming-soon-accent: <?= htmlspecialchars($product['accent']) ?>;">
    <p class="simple-coming-soon-product"><?= htmlspecialchars($product['name']) ?></p>
    <h1>Coming Soon</h1>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
