<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Producten - ElectroShop</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php include 'includes/header.php'; ?>

<!-- Categorieën -->
<div class="filters">
    <?php
    // Categorieën handmatig definiëren omdat er geen centrale 'categories' tabel meer is
    $categories = [
        'laptops' => 'Laptops',
        'smartphones' => 'Smartphones',
        'televisies' => 'Televisies',
        'tablets' => 'Tablets'
    ];

    foreach ($categories as $table => $name):
    ?>
        <button class="filter-btn" data-category="<?= htmlspecialchars($table) ?>"><?= htmlspecialchars($name) ?></button>
    <?php endforeach; ?>
</div>

<!-- Hier komen de producten -->
<section class="products-grid" id="products-grid">
    <p style="text-align:center;">Kies een categorie om producten te bekijken.</p>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.filter-btn');
        const productsGrid = document.getElementById('products-grid');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Active knop styling
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const categoryTable = this.getAttribute('data-category');

                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_products.php?category=' + categoryTable, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        productsGrid.innerHTML = xhr.responseText;
                    } else {
                        productsGrid.innerHTML = '<p>Er is een fout opgetreden.</p>';
                    }
                };
                xhr.send();
            });
        });
    });
</script>

</body>
</html>
