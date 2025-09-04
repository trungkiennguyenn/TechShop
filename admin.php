<?php
session_start();
require 'connection.php';

// Alleen admin toegang
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    echo "Toegang geweigerd.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $image_url = $_POST['image_url'] ?? '';
    $desc = $_POST['description'] ?? '';

    if ($name && $price) {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, image_url, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $price, $image_url, $desc]);
        header('Location: admin.php');
        exit;
    }
}

$products = $pdo->query("SELECT * FROM products")->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Productbeheer</title>
    <style>
        body { background: #111; color: #f5f5f5; font-family: sans-serif; padding: 20px; }
        h2 { color: #e50914; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #444; }
        th { background: #222; }
        form { margin-top: 30px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0; background: #222; color: #fff; border: 1px solid #333; }
        input[type="submit"] { background: #e50914; border: none; cursor: pointer; }
    </style>
</head>
<body>

<h2>Productbeheer (Admin)</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Prijs</th>
        <th>Afbeelding</th>
        <th>Beschrijving</th>
    </tr>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td>€<?= number_format($p['price'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['image_url']) ?></td>
            <td><?= htmlspecialchars($p['description']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Nieuw product toevoegen</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Productnaam" required>
    <input type="text" name="price" placeholder="Prijs (bijv. 499.99)" required>
    <input type="text" name="image_url" placeholder="Afbeeldings-URL (img/voorbeeld.jpg)">
    <textarea name="description" placeholder="Beschrijving"></textarea>
    <input type="submit" value="Toevoegen">
</form>

<p><a href="index.php">Terug naar Home</a></p>
</body>
</html>
