<?php
include 'auth_admin.php';
require '../includes/connection.php';

$category = $_GET['category'] ?? 'tablets';
$id = $_GET['id'] ?? null;

$validCategories = ['laptops', 'smartphones', 'televisies', 'tablets'];
if (!in_array($category, $validCategories)) {
    die("Ongeldige categorie.");
}

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM $category WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: products.php?category=$category");
exit;
