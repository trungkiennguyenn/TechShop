<?php
session_start();
require '../includes/connection.php';

// Controleer login
if (!isset($_SESSION['user_id'])) {
    die("Je moet ingelogd zijn om af te rekenen. <a href='../login.php'>Login</a>");
}

// Controleer winkelwagen
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Je winkelwagen is leeg. <a href='product.php'>Ga winkelen</a>");
}

$cart = $_SESSION['cart'];

// Maak bestelling aan
$stmt = $pdo->prepare("INSERT INTO orders (user_id) VALUES (?)");
$stmt->execute([$_SESSION['user_id']]);
$orderId = $pdo->lastInsertId();

// Voeg order_items toe
$stmt = $pdo->prepare("INSERT INTO order_items (order_id, category, product_id, quantity, price) VALUES (?, ?, ?, ?, ?)");
foreach ($cart as $item) {
    $stmt->execute([
        $orderId,
        $item['category'],
        $item['id'],
        $item['quantity'],
        $item['price']
    ]);
}

// Leeg winkelwagen
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bestelling voltooid</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <h1 style="text-align:center;">Bedankt voor je bestelling!</h1>
    <p style="text-align:center;">Je bestelling is succesvol geplaatst.</p>
    <p style="text-align:center;"><a href="product.php">Verder winkelen</a></p>
</body>
</html>
