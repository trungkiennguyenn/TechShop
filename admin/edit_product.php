<?php
include 'auth_admin.php';
require '../includes/connection.php';

$category = $_GET['category'] ?? 'tablets';
$id = $_GET['id'] ?? null;

$validCategories = ['laptops', 'smartphones', 'televisies', 'tablets'];
if (!in_array($category, $validCategories)) {
    die("Ongeldige categorie.");
}

if (!$id) {
    die("Geen ID meegegeven.");
}

$stmt = $pdo->prepare("SELECT * FROM $category WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die("Product niet gevonden.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];

    $update = $pdo->prepare("UPDATE $category SET name=?, price=?, image_url=?, description=? WHERE id=?");
    $update->execute([$name, $price, $image_url, $description, $id]);

    header("Location: products.php?category=$category");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Product bewerken</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/edit.css">

</head>

<body>
    <h1><?= ucfirst($category) ?> bewerken</h1>
    <form method="post">
        <label>Naam:<br><input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>"
                required></label><br><br>
        <label>Prijs:<br><input type="number" name="price" step="0.01" value="<?= $product['price'] ?>"
                required></label><br><br>
        <label>Afbeeldings-URL:<br><input type="text" name="image_url"
                value="<?= htmlspecialchars($product['image_url']) ?>" required></label><br><br>
        <label>Beschrijving:<br><textarea name="description"
                required><?= htmlspecialchars($product['description']) ?></textarea></label><br><br>
        <button type="submit">Opslaan</button>
    </form>
    <a href="products.php?category=<?= $category ?>">Terug</a>
</body>

</html>