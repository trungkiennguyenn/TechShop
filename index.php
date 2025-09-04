<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ElectroShop</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Basis stijlen voor homepage layout */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; color: #333; }
        .hero { background: url('images/hero-banner.jpg') center/cover no-repeat; height: 400px; display: flex; align-items: center; justify-content: center; color: #fff; text-align: center; }
        .hero h1 { font-size: 3rem; margin-bottom: 15px; }
        .hero p { font-size: 1.2rem; margin-bottom: 25px; }
        .hero .btn { background: #ff5a5f; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .promo-section { display: flex; justify-content: space-around; padding: 40px 20px; background: #fff; }
        .promo { text-align: center; width: 22%; }
        .promo i { font-size: 2rem; color: #ff5a5f; margin-bottom: 10px; }
        .categories, .featured-products { padding: 50px 20px; }
        .section-title { text-align: center; font-size: 2rem; margin-bottom: 40px; }
        .categories-grid, .products-grid { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .category-card, .product-card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; width: 220px; transition: transform 0.2s; }
        .category-card:hover, .product-card:hover { transform: translateY(-5px); }
        .category-card img, .product-card img { width: 100%; height: 150px; object-fit: cover; }
        .category-card h3, .product-card h3 { margin: 15px 0; }
        .category-card a, .product-card a { display: block; padding: 10px 0; background: #ff5a5f; color: #fff; text-decoration: none; border-radius: 0 0 8px 8px; font-weight: bold; }
        .testimonials { background: #ff5a5f; color: #fff; padding: 60px 20px; text-align: center; }
        .testimonial { max-width: 600px; margin: 0 auto 40px auto; font-style: italic; }
        footer { background: #333; color: #fff; padding: 40px 20px; text-align: center; }
        footer a { color: #ff5a5f; text-decoration: none; margin: 0 10px; }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div>
        <h1>Welkom bij ElectroShop</h1>
        <p>De nieuwste gadgets en elektronica binnen handbereik!</p>
        <a href="pages/product.php" class="btn">Shop nu</a>
    </div>
</section>

<!-- Promo Section -->
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
 
<!-- Featured Products -->
<section class="featured-products">
    <h2 class="section-title">Aanbevolen producten</h2>
    <div class="products-grid" id="featured-products">
        <!-- Hier kan je via JS of PHP producten dynamisch laden -->
        <div class="product-card">
            <img src="images/laptop1.jpg" alt="Laptop X">
            <div class="product-info">
                <h3>Laptop X</h3>
                <p>€999,00</p>
                <a href="pages/product_detail.php?category=laptops&id=1">Bekijk</a>
            </div>
        </div>
        <div class="product-card">
            <img src="images/smartphone1.jpg" alt="Smartphone Y">
            <div class="product-info">
                <h3>Smartphone Y</h3>
                <p>€599,00</p>
                <a href="pages/product_detail.php?category=smartphones&id=2">Bekijk</a>
            </div>
        </div>
        <div class="product-card">
            <img src="images/televisie1.jpg" alt="TV Z">
            <div class="product-info">
                <h3>TV Z</h3>
                <p>€799,00</p>
                <a href="pages/product_detail.php?category=televisies&id=3">Bekijk</a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <h2>Wat klanten zeggen</h2>
    <div class="testimonial">"Super snelle levering en topkwaliteit producten!" - Jan D.</div>
    <div class="testimonial">"Altijd de nieuwste gadgets beschikbaar, aanrader!" - Lisa K.</div>
    <div class="testimonial">"Goede service en fijne webshop!" - Mark V.</div>
</section>

<!-- Footer -->
<footer>
    &copy; <?= date('Y') ?> ElectroShop. Alle rechten voorbehouden.<br>
</footer>

</body>
</html>
