<?php
require 'connection.php';

// Welke categorie/tabel wordt opgevraagd?
$categoryTable = $_GET['category'] ?? '';

$allowedTables = ['laptops', 'smartphones', 'televisies', 'tablets'];

if (!in_array($categoryTable, $allowedTables)) {
    echo '<p style="text-align:center; color:#ccc;">Ongeldige categorie.</p>';
    exit;
}

// Haal producten op uit de juiste tabel
$sql = "SELECT * FROM $categoryTable ORDER BY name";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();

if (!$products) {
    echo '<p style="text-align:center; color:#ccc;">Geen producten gevonden in deze categorie.</p>';
    exit;
}

// Loop door de producten en toon ze
foreach ($products as $product): ?>
    <div class="product-card">
        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
        <div class="product-info">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p>€<?= number_format($product['price'], 2, ',', '.') ?></p>
        </div>
    </div>
<?php endforeach; ?>
