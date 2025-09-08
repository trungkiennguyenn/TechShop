<?php
include 'auth_admin.php';
require '../includes/connection.php';

// Alle categorieën
$categories = ['laptops', 'smartphones', 'televisies', 'tablets'];

$category = $_GET['category'] ?? 'tablets';
if (!in_array($category, $categories)) {
    $category = 'tablets';
}

$success_message = '';
$image_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $selected_category = $_POST['category'];

    // Controleer categorie
    if (!in_array($selected_category, $categories)) {
        $image_error = "Ongeldige categorie.";
    }
    // Controleer geldige URL
    elseif (!filter_var($image_url, FILTER_VALIDATE_URL)) {
        $image_error = "Ongeldige image URL";
    } else {
        // Controleer of URL naar afbeelding verwijst
        $headers = @get_headers($image_url, 1);
        $contentType = $headers['Content-Type'] ?? '';
        if (is_array($contentType))
            $contentType = $contentType[0];
        if (strpos($contentType, 'image/') !== 0) {
            $image_error = "Ongeldige image URL";
        } else {
            // Voeg product toe
            try {
                $stmt = $pdo->prepare("INSERT INTO $selected_category (name, price, image_url, description) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $price, $image_url, $description]);
                $success_message = "Product succesvol toegevoegd aan '{$selected_category}'!";
                $image_error = '';
                // Formulier resetten na succes
                $_POST = [];
            } catch (Exception $e) {
                $image_error = "Er is iets misgegaan. Product niet toegevoegd.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Nieuw product toevoegen</title>
    <link rel="stylesheet" href="css/add.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <h1>Nieuw product toevoegen</h1>

        <?php if ($success_message): ?>
            <div class="success-msg">
                <?= htmlspecialchars($success_message) ?>
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
                <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
            </label>

            <label>Prijs:
                <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>"
                    required>
            </label>

            <label>Afbeeldings-URL:
                <input type="text" name="image_url" value="<?= htmlspecialchars($_POST['image_url'] ?? '') ?>" required>
                <?php if ($image_error): ?>
                    <span class="error-msg"><?= htmlspecialchars($image_error) ?></span>
                <?php endif; ?>
            </label>

            <label>Beschrijving:
                <textarea name="description" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            </label>

            <button type="submit">Toevoegen</button>
        </form>

        <a href="dashboard.php" class="back-link">Terug</a>
    </div>
</body>

</html>