<?php
session_start();
require '../includes/connection.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: product.php');
    exit;
}

// Haal en valideer POST-waarden
$category   = $_POST['category'] ?? '';
$id         = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$quantity   = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;
if ($quantity < 1) $quantity = 1;

$allowedTables = ['laptops', 'smartphones', 'televisies', 'tablets'];
if (!in_array($category, $allowedTables, true) || $id <= 0) {
    $_SESSION['cart_error'] = 'Ongeldig product.';
    header("Location: product_detail.php?category=" . urlencode($category) . "&id=" . $id);
    exit;
}

$stmt = $pdo->prepare("SELECT id, name, price, image_url FROM {$category} WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    $_SESSION['cart_error'] = 'Product niet gevonden.';
    header("Location: product_detail.php?category=" . urlencode($category) . "&id=" . $id);
    exit;
}

$key = $category . '_' . $product['id'];

// Verander de hoeveelheid van het product in de winkelwagen

if (isset($_SESSION['cart'][$key])) {
    $_SESSION['cart'][$key]['quantity'] += $quantity;
} else {
    $_SESSION['cart'][$key] = [
        'id'        => (int) $product['id'],
        'category'  => $category,
        'name'      => $product['name'],
        'price'     => (float) $product['price'],
        'quantity'  => $quantity,
        'image_url' => $product['image_url']
    ];
}

$_SESSION['cart_success'] = "✅ {$product['name']} is toegevoegd aan je winkelwagen.";

header("Location: product_detail.php?category=" . urlencode($category) . "&id=" . $id);
exit;
