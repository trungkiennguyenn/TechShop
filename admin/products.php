<?php
include 'auth_admin.php';
require '../includes/connection.php';

// Alle categorieën
$categories = ['laptops', 'smartphones', 'televisies', 'tablets'];

$category = $_GET['category'] ?? 'tablets';
if (!in_array($category, $categories)) {
    $category = 'tablets';
}

// Haal producten op
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
    <link rel="stylesheet" href="css/modal.css">
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

    <!-- Delete Selected knop, standaard verborgen -->
    <button id="deleteSelectedBtn" data-category="<?= $category ?>" style="display:none;">🗑️ Delete Selected</button>

    <!-- Succesmelding -->
    <div id="successMessage" class="success-message" style="display:none;">
        ✅ Product(en) succesvol verwijderd!
    </div>

    <table>
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>ID</th>
                <th>Naam</th>
                <th>Prijs</th>
                <th>Afbeelding</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p): ?>
                <tr id="productRow_<?= $p['id'] ?>">
                    <td><input type="checkbox" class="select-product" data-id="<?= $p['id'] ?>"></td>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td>€<?= number_format($p['price'], 2, ',', '.') ?></td>
                    <td><img src="<?= htmlspecialchars($p['image_url']) ?>" width="80"></td>
                    <td>
                        <a href="edit_product.php?category=<?= $category ?>&id=<?= $p['id'] ?>">✏️ Bewerken</a> |
                        <a href="#" class="delete-btn"
                            data-url="delete_product.php?category=<?= $category ?>&id=<?= $p['id'] ?>"
                            data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['name']) ?>">🗑️ Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal voor individuele delete -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Product verwijderen</h2>
            <p id="modalText"></p>
            <div class="modal-actions">
                <button id="confirmDelete" class="btn-danger">Verwijderen</button>
                <button id="cancelDelete" class="btn-secondary">Annuleren</button>
            </div>
        </div>
    </div>

    <script src="admin.js"></script>
</body>

</html>
