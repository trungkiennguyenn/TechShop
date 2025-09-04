// ------ Product.php ------ //
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.filter-btn');
    const productsGrid = document.getElementById('products-grid');

    function fetchCategory(categoryTable) {
        fetch('fetch_products.php?category=' + categoryTable)
            .then(response => {
                if (!response.ok) throw new Error('Netwerkfout');
                return response.text();
            })
            .then(html => {
                productsGrid.innerHTML = html;
            })
            .catch(() => {
                productsGrid.innerHTML = '<p>Er is een fout opgetreden.</p>';
            });
    }

    function activateButton(categoryTable) {
        buttons.forEach(btn => btn.classList.remove('active'));
        const btn = document.querySelector(`.filter-btn[data-category="${categoryTable}"]`);
        if (btn) btn.classList.add('active');
    }

    // Klik-event voor handmatige filter
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const categoryTable = this.getAttribute('data-category');
            activateButton(categoryTable);
            fetchCategory(categoryTable);
        });
    });

    // **Auto filter op basis van URL ?category=**
    const urlParams = new URLSearchParams(window.location.search);
    const categoryFromURL = urlParams.get('category');
    if (categoryFromURL && buttons.length) {
        activateButton(categoryFromURL);
        fetchCategory(categoryFromURL);
    }
});

document.getElementById('apply-price-filter').addEventListener('click', () => {
    const min = parseFloat(document.getElementById('price-min').value);
    const max = parseFloat(document.getElementById('price-max').value);

    // Fetch of filter producten op prijs (ajax of frontend filtering)
    fetch(`../pages/get_products.php?min_price=${min}&max_price=${max}`)
        .then(response => response.json())
        .then(products => {
            const grid = document.getElementById('products-grid');
            grid.innerHTML = '';
            if (products.length === 0) {
                grid.innerHTML = '<p style="text-align:center;">Geen producten gevonden.</p>';
            } else {
                products.forEach(product => {
                    const div = document.createElement('div');
                    div.classList.add('product-card');
                    div.innerHTML = `
                        <a href="product_detail.php?category=${product.category}&id=${product.id}">
                            <img src="${product.image_url}" alt="${product.name}" />
                            <div class="product-info">
                                <h3>${product.name}</h3>
                                <p>€${product.price.toFixed(2)}</p>
                            </div>
                        </a>
                    `;
                    grid.appendChild(div);
                });
            }
        });
});
