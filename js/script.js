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

    // Auto filter op basis van URL ?category=**
    const urlParams = new URLSearchParams(window.location.search);
    const categoryFromURL = urlParams.get('category');
    if (categoryFromURL && buttons.length) {
        activateButton(categoryFromURL);
        fetchCategory(categoryFromURL);
    }
});


// Functie voor fail message (niet ingelogd)
function showFailMessage() {
    const failMsg = document.getElementById("failMessage");
    if (failMsg) {
        failMsg.style.display = "block";
        setTimeout(() => {
            failMsg.style.display = "none";
        }, 3000);
    }
}

// Succes addded to cart message
 document.addEventListener("DOMContentLoaded", function() {
            const success = document.getElementById('successMessage');
            if (success) {
                success.style.display = 'block';
                setTimeout(() => {
                    success.style.display = 'none';
                }, 3000);
            }

            window.showFailMessage = function() {
                const fail = document.getElementById('failMessage');
                if (fail) {
                    fail.style.display = 'block';
                    setTimeout(() => {
                        fail.style.display = 'none';
                    }, 3000);
                }
            }
        });

        