<?php
require_once '../includes/header.php';
require '../includes/connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];

// Haal alle orders van deze gebruiker
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn bestellingen - ElectroShop</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/orders.css">
</head>
<body>
<div class="orders-container">
    <h1>🧾 Mijn bestellingen</h1>

    <?php if (empty($orders)): ?>
        <div class="empty-orders">
            <p>Je hebt nog geen bestellingen geplaatst.</p>
            <a href="product.php" class="btn btn-primary">Verder winkelen</a>
        </div>
    <?php else: ?>
        <?php foreach ($orders as $order): 
            // Haal order items op
            $stmtItems = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
            $stmtItems->execute([$order['id']]);
            $items = $stmtItems->fetchAll();
        ?>
            <div class="order-card">
                <h2>Bestelling #<?= $order['id'] ?> — <?= date('d-m-Y H:i', strtotime($order['created_at'])) ?></h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Afbeelding</th>
                            <th>Product</th>
                            <th>Categorie</th>
                            <th>Aantal</th>
                            <th>Prijs</th>
                            <th>Totaal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $orderTotal = 0;
                        foreach ($items as $item):
                            // Haal product info op: name + image_url
                            $stmtProd = $pdo->prepare("SELECT name, image_url FROM {$item['category']} WHERE id = ?");
                            $stmtProd->execute([$item['product_id']]);
                            $prodData = $stmtProd->fetch();

                            $productName = $prodData['name'] ?? 'Onbekend product';
                            $imageUrl = $prodData['image_url'] ?? '../img/no-image.png';

                            $lineTotal = $item['price'] * $item['quantity'];
                            $orderTotal += $lineTotal;
                        ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($productName) ?>" class="order-img"></td>
                            <td><?= htmlspecialchars($productName) ?></td>
                            <td><?= htmlspecialchars($item['category']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>€<?= number_format($item['price'], 2, ',', '.') ?></td>
                            <td>€<?= number_format($lineTotal, 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="order-total">
                    <strong>Totaal bestelling: €<?= number_format($orderTotal, 2, ',', '.') ?></strong>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
