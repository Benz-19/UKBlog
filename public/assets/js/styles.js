document.addEventListener('DOMContentLoaded', () => {

    const openMenu = document.getElementsByClassName('open-menu')[0];
    const closeMenu = document.querySelector('.close-menu');
    const menuContent = document.getElementsByClassName('menu-btn-content')[0];
    console.log("yes");
    if (openMenu) {
        openMenu.addEventListener('click', () => {
            closeMenu.classList.toggle('hidden');
            openMenu.classList.add('hidden');
            menuContent.classList.add('block');
        })
    }

    if (closeMenu) {
        closeMenu.addEventListener('click', () => {
            console.log("close btn");
            closeMenu.classList.add('hidden');              // Hide the 'X' icon
            openMenu.classList.remove('hidden');            // Show the burger icon
            menuContent.classList.remove('block');          // Hide the dropdown
            menuContent.classList.add('hidden');            // Ensure it disappears
        });
    }

})
