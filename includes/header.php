<?php session_start(); ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ElectroShop</title>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- Bovenste rode balk -->
<header class="main-header">
    <div class="logo">ElectroShop</div>

    <div class="search-container">
        <input type="text" placeholder="Wat zoek je?" />
        <i class="fas fa-search"></i>
    </div>

    <div class="header-icons">
        <!-- Profiel -->
        <div class="icon profile-icon" onclick="toggleProfileMenu()">
            <i class="fas fa-user"></i>
        </div>
        <div id="profile-menu" class="profile-menu hidden">
            <?php if (isset($_SESSION['user_id'])): ?>
                <p>Hallo, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
                <hr>
                <a href="profile.php">Profiel</a>
                <a href="orders.php">Bestellingen</a>
                <a href="logout.php">Uitloggen</a>
            <?php else: ?>
                <p>Welkom terug!</p>
                <hr>
                <a href="login.php">Inloggen</a>
                <a href="register.php">Registreren</a>
            <?php endif; ?>
        </div>

        <!-- Favorieten -->
        <div class="icon">
            <i class="fas fa-heart"></i>
        </div>

        <!-- Winkelwagen -->
        <div class="icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
    </div>
</header>

<!-- Promo bar -->
<div class="promo-bar">
    <span>Binnen 30 minuten ophalen</span>
    <span>Niet tevreden? 100% geld terug!</span>
    <span>Voor 23:59 besteld, morgen in huis</span>
</div>


<!-- Navigatiebalk met alleen Home en Producten -->
<nav class="main-nav">
    <?php if (basename($_SERVER['PHP_SELF']) !== 'index.php'): ?>
        <a href="index.php">Home</a>
    <?php endif; ?>

    <?php if (basename($_SERVER['PHP_SELF']) !== 'product.php'): ?>
        <a href="product.php">Producten</a>
    <?php endif; ?>
</nav>


<script>
function toggleProfileMenu() {
    const menu = document.getElementById('profile-menu');
    menu.classList.toggle('hidden');
}

document.addEventListener('click', function(event) {
    const menu = document.getElementById('profile-menu');
    const icon = document.querySelector('.profile-icon');
    if (!menu.contains(event.target) && !icon.contains(event.target)) {
        menu.classList.add('hidden');
    }
});
</script>
