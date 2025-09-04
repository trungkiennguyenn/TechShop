<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Voeg product toe via GET (bijv: cart.php?action=add&id=2)
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header("Location: cart.php");
    exit;
}

// Verwijder item
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Ophalen producten
$products = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        $total += $product['price'] * $_SESSION['cart'][$product['id']];
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
    <style>
        body { background: #111; color: #f5f5f5; font-family: sans-serif; padding: 20px; }
        h2 { text-align: center; color: #e50914; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #444; padding: 10px; text-align: center; }
        th { background-color: #222; }
        a { color: #e50914; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Winkelwagen</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Je winkelwagen is leeg.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Prijs</th>
                <th>Aantal</th>
                <th>Subtotaal</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td>€<?= number_format($product['price'], 2, ',', '.') ?></td>
                    <td><?= $_SESSION['cart'][$product['id']] ?></td>
                    <td>€<?= number_format($product['price'] * $_SESSION['cart'][$product['id']], 2, ',', '.') ?></td>
                    <td><a href="cart.php?action=remove&id=<?= $product['id'] ?>">Verwijder</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h3>Totaal: €<?= number_format($total, 2, ',', '.') ?></h3>
    <?php endif; ?>
    <p><a href="index.php">Verder winkelen</a></p>
</body>
</html>
