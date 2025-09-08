<?php
require_once '../includes/header.php';
require '../includes/connection.php';

$category = $_GET['category'] ?? '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$allowedTables = ['laptops', 'smartphones', 'televisies', 'tablets'];
if (!in_array($category, $allowedTables) || !$id) {
    exit('Ongeldig product.');
}

// Haal basisgegevens van het product op
$stmt = $pdo->prepare("SELECT * FROM $category WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product)
    exit('Product niet gevonden.');

// Mapping categorie → details-tabel
$detailTables = [
    'laptops' => 'laptop_details',
    'smartphones' => 'smartphone_details',
    'televisies' => 'televisie_details',
    'tablets' => 'tablet_details'
];
$detailsTable = $detailTables[$category];

// Haal details op uit de details-tabel
$stmt2 = $pdo->prepare("SELECT attribute, value FROM $detailsTable WHERE product_id = ?");
$stmt2->execute([$id]);
$details = $stmt2->fetchAll();

$categoryParam = urlencode($category);
$userLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - ElectroShop</title>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <?php if (isset($_SESSION['cart_success'])): ?>
        <div id="successMessage" class="success-message">
            <?= $_SESSION['cart_success']; ?>
        </div>
        <?php unset($_SESSION['cart_success']); ?>
    <?php endif; ?>

    <?php if (!$userLoggedIn): ?>
        <div id="failMessage" class="fail-message">
            ❌ Je moet ingelogd zijn om producten toe te voegen!
        </div>
    <?php endif; ?>

    <div class="back-button-container">
        <a href="product.php?category=<?= $categoryParam ?>" class="back-btn">&larr; Terug naar
            <?= htmlspecialchars($category) ?></a>
    </div>

    <div class="product-detail-container">
        <div class="product-detail-card">
            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <div class="product-detail-info">
                <h1><?= htmlspecialchars($product['name']) ?></h1>
                <p class="price">€<?= number_format($product['price'], 2, ',', '.') ?></p>
                <p><?= htmlspecialchars($product['description']) ?></p>

                <h3>Specificaties</h3>
                <ul class="product-specs">
                    <?php foreach ($details as $detail): ?>
                        <li><strong><?= htmlspecialchars($detail['attribute']) ?>:</strong>
                            <?= htmlspecialchars($detail['value']) ?></li>
                    <?php endforeach; ?>
                </ul>

                <form method="post" action="add_to_cart.php" class="add-to-cart-form"
                    onsubmit="<?= $userLoggedIn ? '' : 'event.preventDefault(); showFailMessage();' ?>">
                    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
                    <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                    <label>
                        Aantal:
                        <input type="number" name="quantity" value="1" min="1" required>
                    </label>
                    <button type="submit" name="add_to_cart">🛒 In winkelwagen</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>

</body>

</html>