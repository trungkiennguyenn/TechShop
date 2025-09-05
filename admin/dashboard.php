<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ElectroShop</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

    <?php include 'adminheader.php'; ?>

    <main class="admin-dashboard">
        <h1>Admin Dashboard</h1>
        <p>Welkom terug, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!</p>

        <div class="admin-links">
            <a href="products.php">📋 Producten beheren</a>
            <a href="add_product.php">➕ Nieuw product toevoegen</a>
        </div>
    </main>

</body>

</html>