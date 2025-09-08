function toggleProfileMenu() {
    const menu = document.getElementById('profile-menu');
    menu.classList.toggle('hidden');
}

document.addEventListener('click', function (event) {
    const menu = document.getElementById('profile-menu');
    const icon = document.querySelector('.profile-icon');
    if (!menu.contains(event.target) && !icon.contains(event.target)) {
        menu.classList.add('hidden');
    }
});

// Products.php - Delete modal

document.addEventListener("DOMContentLoaded", () => {
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const modal = document.getElementById("deleteModal");
    const modalText = document.getElementById("modalText");
    const confirmDelete = document.getElementById("confirmDelete");
    const cancelDelete = document.getElementById("cancelDelete");
    const successMessage = document.getElementById("successMessage");
    let deleteUrl = "";

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            deleteUrl = btn.dataset.url;
            modalText.textContent = `Weet je zeker dat je "${btn.dataset.name}" wilt verwijderen?`;
            modal.style.display = "flex";
        });
    });

    confirmDelete.addEventListener("click", () => {
        fetch(deleteUrl)
            .then(res => res.ok ? res.text() : Promise.reject("Fout bij verwijderen"))
            .then(() => {
                modal.style.display = "none";
                successMessage.style.display = "block";
                setTimeout(() => {
                    location.reload(); // pagina vernieuwen
                }, 1500);
            })
            .catch(err => alert(err));
    });

    cancelDelete.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Klik buiten modal sluit deze
    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });
});

// Delete Selected products

document.addEventListener('DOMContentLoaded', () => {

    const checkboxes = document.querySelectorAll('.select-product');
    const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
    const selectAll = document.getElementById('selectAll');
    const successMessage = document.getElementById('successMessage');

    const deleteModal = document.getElementById('deleteModal');
    const modalText = document.getElementById('modalText');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelDeleteBtn = document.getElementById('cancelDelete');

    let deleteUrl = null;
    let deleteRows = []; // kan meerdere rijen bevatten voor geselecteerde items

    // Update zichtbaarheid Delete Selected knop
    function updateDeleteButton() {
        const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
        if (deleteSelectedBtn) deleteSelectedBtn.style.display = anyChecked ? 'inline-block' : 'none';
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateDeleteButton));

    if (selectAll) {
        selectAll.addEventListener('change', () => {
            const checked = selectAll.checked;
            checkboxes.forEach(cb => cb.checked = checked);
            updateDeleteButton();
        });
    }

    // Individuele delete knop - open modal
    const deleteBtns = document.querySelectorAll('.delete-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            deleteUrl = btn.dataset.url;
            deleteRows = [btn.dataset.id];

            if (modalText) {
                modalText.textContent = `Weet je zeker dat je "${btn.dataset.name}" wilt verwijderen?`;
            }
            if (deleteModal) deleteModal.style.display = 'block';
        });
    });

    // Delete Selected - open dezelfde modal
    if (deleteSelectedBtn) {
        deleteSelectedBtn.addEventListener('click', () => {
            deleteRows = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.dataset.id);

            if (deleteRows.length === 0) return;

            const category = deleteSelectedBtn.dataset.category;
            deleteUrl = `delete_product.php?category=${category}&ids=${deleteRows.join(',')}`;

            if (modalText) {
                modalText.textContent = `Weet je zeker dat je deze ${deleteRows.length} producten wilt verwijderen?`;
            }
            if (deleteModal) deleteModal.style.display = 'block';
        });
    }

    // Bevestig verwijdering in modal
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', () => {
            if (!deleteUrl || deleteRows.length === 0) return;

            fetch(deleteUrl)
                .then(() => {
                    if (successMessage) {
                        successMessage.style.display = 'block';
                        setTimeout(() => successMessage.style.display = 'none', 3000);
                    }
                    deleteRows.forEach(id => {
                        const row = document.getElementById('productRow_' + id);
                        if (row) row.remove();
                    });
                    updateDeleteButton();
                    deleteUrl = null;
                    deleteRows = [];
                    if (deleteModal) deleteModal.style.display = 'none';
                })
                .catch(err => console.error(err));
        });
    }

    // Annuleer verwijdering
    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', () => {
            if (deleteModal) deleteModal.style.display = 'none';
            deleteUrl = null;
            deleteRows = [];
        });
    }

    // Sluit modal bij click buiten
    window.addEventListener('click', (e) => {
        if (e.target === deleteModal) {
            deleteModal.style.display = 'none';
            deleteUrl = null;
            deleteRows = [];
        }
    });

});

