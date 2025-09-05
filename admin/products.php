<?php
include 'auth_admin.php';
require '../includes/connection.php';

// Bepaalt de categorie
$category = $_GET['category'] ?? 'tablets';

// Checkt of de categorie geldig is
$validCategories = ['laptops', 'smartphones', 'televisies', 'tablets'];
if (!in_array($category, $validCategories)) {
    die("Ongeldige categorie.");
}

// Haalt de producten op
$stmt = $pdo->query("SELECT * FROM $category ORDER BY id DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Admin - <?= ucfirst($category) ?> Beheer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/admin.css">


</head>

<body>
    <?php include 'adminheader.php'; ?>

    <h1><?= ucfirst($category) ?> Beheer</h1>

    <nav>
        <a href="products.php?category=laptops">Laptops</a> |
        <a href="products.php?category=smartphones">Smartphones</a> |
        <a href="products.php?category=televisies">Televisies</a> |
        <a href="products.php?category=tablets">Tablets</a>
    </nav>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Afbeelding</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td>€<?= number_format($p['price'], 2, ',', '.') ?></td>
                <td><img src="<?= htmlspecialchars($p['image_url']) ?>" width="80"></td>
                <td>
                    <a href="edit_product.php?category=<?= $category ?>&id=<?= $p['id'] ?>">✏️ Bewerken</a> |
                    <a href="delete_product.php?category=<?= $category ?>&id=<?= $p['id'] ?>"
                        onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">🗑️ Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>