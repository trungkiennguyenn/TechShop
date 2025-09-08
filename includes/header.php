<?php
session_start();

// Bepaal pad-prefix één keer bovenaan
$isInPages = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false);
$prefix = $isInPages ? '' : 'pages/';

// Huidige pagina bepalen
$currentPage = basename($_SERVER['PHP_SELF']);

if ($currentPage === 'search_results.php') {
    $homeLink = 'index.php';
    $productLink = 'pages/product.php';
} elseif ($isInPages) {
    $homeLink = '../index.php';
    $productLink = 'product.php';
} else {
    $homeLink = 'index.php';
    $productLink = 'pages/product.php';
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ElectroShop</title>
    <link rel="stylesheet" href="<?= $isInPages ? '../pages/css/style.css' : 'pages/css/style.css' ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <header class="main-header">
        <div class="logo">ElectroShop</div>

        <div class="search-container">
            <form action="<?= $isInPages ? '../search_results.php' : 'search_results.php' ?>" method="get"
                class="search-form">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
                <input type="text" name="query" placeholder="Wat zoek je?" required />
            </form>
        </div>

        <div class="header-icons">
            <div class="icon profile-icon" onclick="toggleProfileMenu()">
                <i class="fas fa-user"></i>
            </div>
            <div id="profile-menu" class="profile-menu hidden">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <p>Hallo, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
                    <hr>
                    <a href="<?= $prefix ?>profile.php">Profiel</a>
                    <?php if ($_SESSION['username'] === 'admin'): ?>
                        <a href="<?= $prefix ?>../admin/dashboard.php">Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="<?= $prefix ?>orders.php">Bestellingen</a>
                    <a href="<?= $prefix ?>logout.php">Uitloggen</a>
                <?php else: ?>
                    <p>Welkom!</p>
                    <hr>
                    <a href="<?= $prefix ?>login.php">Inloggen</a>
                    <a href="<?= $prefix ?>register.php">Registreren</a>
                <?php endif; ?>
            </div>

            <div class="icon"><i class="fas fa-heart"></i></div>
            <a href="<?= $prefix ?>cart.php" class="icon">
                <i class="fas fa-shopping-cart"></i>
            </a>

        </div>
    </header>

    <div class="promo-bar">
        <span>Binnen 30 minuten ophalen</span>
        <span>Niet tevreden? 100% geld terug!</span>
        <span>Voor 23:59 besteld, morgen in huis</span>
    </div>

    <nav class="main-nav">
        <?php if ($currentPage !== 'index.php'): ?>
            <a href="<?= $homeLink ?>">Home</a>
        <?php endif; ?>

        <?php if ($currentPage !== 'product.php'): ?>
            <a href="<?= $productLink ?>">Producten</a>
        <?php endif; ?>
    </nav>

<?php

// Checkt of we in de 'pages' map zitten
$isInPages = strpos($_SERVER['PHP_SELF'], '/pages/') !== false;
?>

<script src="<?= $isInPages ? '../js/header.js' : 'js/header.js' ?>"></script>

