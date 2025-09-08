<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ElectroShop</title>
    <link rel="stylesheet"
        href="<?= (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../css/style.css' : 'pages/css/style.css' ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <?php
    // Zorgt ervoor dat prefix altijd beschikbaar is
    $prefix = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '' : 'pages/';
    ?>

    <header class="main-header">
        <div class="logo">ElectroShop</div>

        <a href="../index.php" class="btn-exit">Exit Dashboard</a>

        <div class="header-icons">

            <?php if (basename($_SERVER['PHP_SELF']) !== 'dashboard.php'): ?>
                <div class="back-to-dashboard">
                    <a href="dashboard.php" class="btn-back">Terug naar Dashboard</a>
                </div>
            <?php endif; ?>

            <div class="icon profile-icon" onclick="toggleProfileMenu()">
                <i class="fas fa-user"></i>
            </div>


            <div id="profile-menu" class="profile-menu hidden">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <p>Hallo, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
                    <hr>
                    <a href="<?= $prefix ?>profile.php">Profiel</a>
                    <a href="<?= $prefix ?>orders.php">Bestellingen</a>

                    <?php if ($_SESSION['username'] === 'admin'): ?>
                        <a href="<?= $prefix ?>../admin/dashboard.php">Admin Dashboard</a>
                    <?php endif; ?>

                    <a href="<?= $prefix ?>logout.php">Uitloggen</a>
                <?php else: ?>
                    <p>Welkom terug!</p>
                    <hr>
                    <a href="<?= $prefix ?>login.php">Inloggen</a>
                    <a href="<?= $prefix ?>register.php">Registreren</a>
                <?php endif; ?>
            </div>


        </div>
    </header>

    <script src="admin.js"></script>
</body>