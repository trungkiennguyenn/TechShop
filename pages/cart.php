<?php
require_once '../includes/header.php';
require '../includes/connection.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="cart-container">
        <h1>🛒 Jouw winkelwagen</h1>

        <?php if (empty($cart)): ?>
            <div class="empty-cart">
                <p>Je winkelwagen is momenteel leeg.</p>
                <a href="product.php" class="btn btn-primary">Verder winkelen</a>
            </div>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Aantal</th>
                        <th>Prijs</th>
                        <th>Totaal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $key => $item):
                        $lineTotal = $item['price'] * $item['quantity'];
                        $total += $lineTotal;
                        ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars($item['image_url'] ?? '../img/no-image.png') ?>"
                                    alt="<?= htmlspecialchars($item['name']) ?>" class="cart-img">
                            </td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>€<?= number_format($item['price'], 2, ',', '.') ?></td>
                            <td>€<?= number_format($lineTotal, 2, ',', '.') ?></td>
                            <td><a href="remove_from_cart.php?key=<?= $key ?>" class="remove-btn">Verwijder</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <h2>Totaal: €<?= number_format($total, 2, ',', '.') ?></h2>
                <div class="cart-actions">
                    <a href="product.php" class="btn btn-secondary">Verder winkelen</a>
                    <a href="checkout.php" class="btn btn-primary">Kopen</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>