document.addEventListener('DOMContentLoaded', () => {

    const openMenu = document.getElementsByClassName('open-menu')[0];
    const closeMenu = document.getElementsByClassName('close-menu')[0];
    const menuContent = document.getElementsByClassName('menu-btn-content')[0];
    console.log("yes");
    if (openMenu) {
        openMenu.addEventListener('click', () => {
            closeMenu.classList.toggle('block');
            openMenu.classList.add('hidden');
            menuContent.classList.add('block');
        })
    }
})
