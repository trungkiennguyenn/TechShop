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

document.addEventListener("DOMContentLoaded", () => {
    const deleteModal = document.getElementById("deleteModal");
    const modalText = document.getElementById("modalText");
    const confirmDeleteBtn = document.getElementById("confirmDelete");
    const cancelDeleteBtn = document.getElementById("cancelDelete");
    const successMessage = document.getElementById("successMessage");

    const checkboxes = document.querySelectorAll(".select-product");
    const deleteSelectedBtn = document.getElementById("deleteSelectedBtn");
    const selectAll = document.getElementById("selectAll");

    let deleteUrl = null;
    let deleteRows = [];

    function openModal(message, url, rows) {
        modalText.textContent = message;
        deleteUrl = url;
        deleteRows = rows;
        deleteModal.classList.add("show");
    }

    function closeModal() {
        deleteModal.classList.remove("show");
        deleteUrl = null;
        deleteRows = [];
    }

    function updateDeleteButton() {
        const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
        if (deleteSelectedBtn) deleteSelectedBtn.style.display = anyChecked ? "inline-block" : "none";
    }

    // Individueel verwijderen
    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", e => {
            e.preventDefault();
            const url = btn.dataset.url;
            const id = btn.dataset.id;
            const name = btn.dataset.name;

            openModal(`Weet je zeker dat je "${name}" wilt verwijderen?`, url, [id]);
        });
    });

    // Meerdere verwijderen
    if (deleteSelectedBtn) {
        deleteSelectedBtn.addEventListener("click", () => {
            const rows = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.dataset.id);

            if (rows.length === 0) return;

            const category = deleteSelectedBtn.dataset.category;
            const url = `delete_product.php?category=${category}&ids=${rows.join(",")}`;

            openModal(`Weet je zeker dat je deze ${rows.length} producten wilt verwijderen?`, url, rows);
        });
    }

    // Confirm delete
    confirmDeleteBtn.addEventListener("click", () => {
        if (!deleteUrl || deleteRows.length === 0) return;

        fetch(deleteUrl)
            .then(res => res.ok ? res.text() : Promise.reject("Fout bij verwijderen"))
            .then(() => {
                successMessage.style.display = "block";
                setTimeout(() => successMessage.style.display = "none", 3000);

                deleteRows.forEach(id => {
                    const row = document.getElementById("productRow_" + id);
                    if (row) row.remove();
                });

                updateDeleteButton();
                closeModal();
            })
            .catch(err => alert(err));
    });

    cancelDeleteBtn.addEventListener("click", closeModal);

    window.addEventListener("click", e => {
        if (e.target === deleteModal) closeModal();
    });

    checkboxes.forEach(cb => cb.addEventListener("change", updateDeleteButton));

    if (selectAll) {
        selectAll.addEventListener("change", () => {
            const checked = selectAll.checked;
            checkboxes.forEach(cb => (cb.checked = checked));
            updateDeleteButton();
        });
    }
});
