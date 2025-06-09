document.addEventListener('DOMContentLoaded', () => {
    // Menu toggle logic
    const openMenu = document.getElementsByClassName('open-menu')[0];
    const closeMenu = document.querySelector('.close-menu');
    const menuContent = document.getElementsByClassName('menu-btn-content')[0];

    if (openMenu) {
        openMenu.addEventListener('click', () => {
            closeMenu.classList.remove('hidden');        // Show the close "X" icon
            openMenu.classList.add('hidden');            // Hide the open "≡" icon
            menuContent.classList.remove('hidden');      // Show the menu content
            menuContent.classList.add('block');
        });
    }

    if (closeMenu) {
        closeMenu.addEventListener('click', () => {
            closeMenu.classList.add('hidden');           // Hide the close "X" icon
            openMenu.classList.remove('hidden');         // Show the open "≡" icon
            menuContent.classList.remove('block');       // Remove block display
            menuContent.classList.add('hidden');         // Ensure it disappears
        });
    }

    // Accordion logic
    document.querySelectorAll('.post-title').forEach(title => {
        title.addEventListener('click', function () {
            const container = this.parentElement;

            // Optional: Collapse other open accordions (uncomment if needed)
            // document.querySelectorAll('.post-container.active').forEach(active => {
            //     if (active !== container) {
            //         active.classList.remove('active');
            //     }
            // });

            container.classList.toggle('active');
        });
    });
});
