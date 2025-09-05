<?php
include 'auth_admin.php';
require '../includes/connection.php';

// Alle categorieën
$categories = ['laptops', 'smartphones', 'televisies', 'tablets'];

$category = $_GET['category'] ?? 'tablets';
if (!in_array($category, $categories)) {
    $category = 'tablets';
}

$status = '';       // voor statusmelding
$status_type = '';  // 'success' of 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $selected_category = $_POST['category'];

    if (!in_array($selected_category, $categories)) {
        $status = "Ongeldige categorie.";
        $status_type = 'error';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO $selected_category (name, price, image_url, description) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $price, $image_url, $description]);

            $status = "Product succesvol toegevoegd aan '{$selected_category}'!";
            $status_type = 'success';
        } catch (Exception $e) {
            $status = "Er is iets misgegaan. Product niet toegevoegd.";
            $status_type = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuw product toevoegen</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
    <h1>Nieuw product toevoegen</h1>
    <div class="container">
        <?php if ($status): ?>
            <div class="status-box <?= $status_type ?>">
                <?= htmlspecialchars($status) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <label>Categorie:
                <select name="category" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat ?>" <?= $cat === $category ? 'selected' : '' ?>>
                            <?= ucfirst($cat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>Naam:
                <input type="text" name="name" required>
            </label>

            <label>Prijs:
                <input type="number" name="price" step="0.01" required>
            </label>

            <label>Afbeeldings-URL:
                <input type="text" name="image_url" required>
            </label>

            <label>Beschrijving:
                <textarea name="description" required></textarea>
            </label>

            <button type="submit">Toevoegen</button>
        </form>

        <a href="dashboard.php" class="back-link">Terug</a>
    </div>
</body>
</html>
