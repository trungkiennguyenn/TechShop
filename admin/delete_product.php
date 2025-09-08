<?php
include 'auth_admin.php';
require '../includes/connection.php';

$category = $_GET['category'] ?? 'tablets';
$id = $_GET['id'] ?? null;
$ids = $_GET['ids'] ?? null; // comma-separated IDs voor multi-delete

$validCategories = ['laptops', 'smartphones', 'televisies', 'tablets'];
if (!in_array($category, $validCategories)) {
    die("Ongeldige categorie.");
}

// Enkele delete
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM $category WHERE id = ?");
    $stmt->execute([$id]);
}

// Meerdere delete
if ($ids) {
    // Maak een array van integers
    $idArray = array_filter(array_map('intval', explode(',', $ids)));
    if (!empty($idArray)) {
        $placeholders = implode(',', array_fill(0, count($idArray), '?'));
        $stmt = $pdo->prepare("DELETE FROM $category WHERE id IN ($placeholders)");
        $stmt->execute($idArray);
    }
}

header("Location: products.php?category=$category");
exit;
