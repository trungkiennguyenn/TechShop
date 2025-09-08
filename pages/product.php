<?php
require_once '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Producten - ElectroShop</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

    <section class="categories">
        <h2 class="section-title">Categorieën</h2>
        <div class="categories-grid">
            <?php

            $categories = [
                'laptops' => ['name' => 'Laptops'],
                'smartphones' => ['name' => 'Smartphones'],
                'televisies' => ['name' => 'Televisies'],
                'tablets' => ['name' => 'Tablets']
            ];

            foreach ($categories as $key => $cat):
                ?>
                <div class="category-card">
                    <h3><?= htmlspecialchars($cat['name']) ?></h3>
                    <a href="#" class="filter-btn" data-category="<?= htmlspecialchars($key) ?>">Bekijk</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="products-grid" id="products-grid">
    </section>

    <script src="../js/script.js"></script>

</body>

</html>