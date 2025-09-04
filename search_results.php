<?php
require 'includes/connection.php';

$query = $_GET['query'] ?? '';
$query = trim($query);

if ($query === '') {
    echo 'Geen zoekterm opgegeven.';
    exit;
}

// Zoek in alle categorieën
$allowedTables = ['laptops', 'smartphones', 'televisies', 'tablets'];

$results = [];

foreach ($allowedTables as $table) {
    $stmt = $pdo->prepare("SELECT id, name, price, image_url FROM $table WHERE name LIKE ? ORDER BY name");
    $stmt->execute(["%$query%"]);
    $found = $stmt->fetchAll();
    if ($found) {
        foreach ($found as $row) {
            $row['category'] = $table;
            $results[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoekresultaten voor "<?= htmlspecialchars($query) ?>" - ElectroShop</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <h1 style="text-align:center; margin:20px 0;">Zoekresultaten voor "<?= htmlspecialchars($query) ?>"</h1>

    <div class="products-grid">
        <?php if (count($results) === 0): ?>
            <p style="text-align:center;">Geen producten gevonden.</p>
        <?php else: ?>
            <?php foreach ($results as $product): ?>
                <div class="product-card">
                    <a href="pages/product_detail.php?category=<?= $product['category'] ?>&id=<?= $product['id'] ?>">
                        <img src="<?= htmlspecialchars($product['image_url']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>" />
                        <div class="product-info">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <p>€<?= number_format($product['price'], 2, ',', '.') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>

</html>