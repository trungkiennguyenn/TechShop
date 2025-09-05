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
