<?php
require_once '../includes/header.php';
require '../includes/connection.php';

// Controleer login
if (!isset($_SESSION['user_id'])) {
    die("Je moet ingelogd zijn om af te rekenen. <a href='../login.php'>Login</a>");
}

$cart = $_SESSION['cart'] ?? [];

if (!empty($cart)) {
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

    unset($_SESSION['cart']);

    $messageTitle = "Bedankt voor je bestelling!";
    $messageText = "Je bestelling is succesvol geplaatst.";
} else {
    $messageTitle = "Je winkelwagen is leeg";
    $messageText = " <a href='product.php'>Ga winkelen</a>.";
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="checkout-container">
        <div class="checkout-card">
            <h1><?= $messageTitle ?></h1>
            <p><?= $messageText ?></p>
            <?php if (!empty($cart)): ?>
                <a href="product.php">Verder winkelen</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>