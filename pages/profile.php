<?php
require_once '../includes/header.php';
require '../includes/connection.php';

$username = $_SESSION['username'] ?? 'Gast';
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Mijn Profiel</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <div class="profile-wrapper">
        <div class="profile-card">
            <div class="profile-header">
                <div class="avatar">
                    <span><?= strtoupper(substr($username, 0, 1)) ?></span>
                </div>
                <h1>Hallo, <strong><?= htmlspecialchars($username) ?></strong> 👋</h1>
            </div>

            <div class="profile-actions">
                <a href="orders.php" class="action-card">
                    <i class="icon">📦</i>
                    <h3>Mijn bestellingen</h3>
                    <p>Bekijk je bestelgeschiedenis</p>
                </a>
                <a href="wishlist.php" class="action-card">
                    <i class="icon">❤️</i>
                    <h3>Mijn wishlist</h3>
                    <p>Sla producten op die je later wilt bekijken</p>
                </a>
                <a href="logout.php" class="action-card logout">
                    <i class="icon">🚪</i>
                    <h3>Uitloggen</h3>
                    <p>Veilig uitloggen van je account</p>
                </a>
            </div>
        </div>
    </div>
</body>

</html>