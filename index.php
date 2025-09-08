<?php
require_once 'includes/header.php';
require 'includes/connection.php';

$featuredCategories = ['laptops', 'smartphones', 'televisies'];
$featuredProducts = [];

foreach ($featuredCategories as $category) {
    $stmt = $pdo->query("SELECT * FROM $category ORDER BY id DESC LIMIT 1");
    $product = $stmt->fetch();
    if ($product) {
        $product['category'] = $category;
        $featuredProducts[] = $product;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ElectroShop</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <section class="hero">
        <div>
            <h1>Welkom bij ElectroShop</h1>
            <p>De nieuwste gadgets en elektronica binnen handbereik!</p>
            <a href="pages/product.php" class="btn">Shop nu</a>
        </div>
    </section>

    <section class="promo-section">
        <div class="promo">
            <i class="fas fa-shipping-fast"></i>
            <h3>Snelle levering</h3>
            <p>Bestel voor 23:59 en morgen in huis!</p>
        </div>
        <div class="promo">
            <i class="fas fa-money-bill-wave"></i>
            <h3>Geld terug garantie</h3>
            <p>Niet tevreden? 100% terugbetaling.</p>
        </div>
        <div class="promo">
            <i class="fas fa-headset"></i>
            <h3>Klantenservice 24/7</h3>
            <p>Altijd bereikbaar voor al je vragen.</p>
        </div>
        <div class="promo">
            <i class="fas fa-tags"></i>
            <h3>Beste prijzen</h3>
            <p>Wij garanderen de laagste prijzen online.</p>
        </div>
    </section>

    <section class="featured-products">
        <h2 class="section-title">Aanbevolen producten</h2>
        <div class="products-grid" id="featured-products">
            <?php foreach ($featuredProducts as $p): ?>
                <a href="pages/product_detail.php?category=<?= $p['category'] ?>&id=<?= $p['id'] ?>"
                    class="product-card-link">
                    <div class="product-card">
                        <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                        <div class="product-info">
                            <h3><?= htmlspecialchars($p['name']) ?></h3>
                            <p>€<?= number_format($p['price'], 2, ',', '.') ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="testimonials">
        <h2>Wat klanten zeggen</h2>
        <div class="testimonial">"Super snelle levering en topkwaliteit producten!" - Jan D.</div>
        <div class="testimonial">"Altijd de nieuwste gadgets beschikbaar, aanrader!" - Lisa K.</div>
        <div class="testimonial">"Goede service en fijne webshop!" - Mark V.</div>
    </section>

    <footer>
        &copy; <?= date('Y') ?> ElectroShop. Alle rechten voorbehouden.<br>
    </footer>

</body>

</html>