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


    const sliderList = document.getElementById('slider-list');
    const items = document.querySelectorAll('.slider .list .item');
    const prevArrow = document.getElementById('prev-arrow');
    const nextArrow = document.getElementById('next-arrow');

    let currentIndex = 0;
    const totalItems = items.length;

    /**
     * Updates the slider's position to show the current slide.
     */
    function updateSliderPosition() {
        // Calculate the translation needed for the slider list
        // Each item takes 100% of the slider's width
        sliderList.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    /**
     * Moves the slider to the next slide.
     * Loops back to the first slide if at the end.
     */
    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalItems;
        updateSliderPosition();
    }

    /**
     * Moves the slider to the previous slide.
     * Loops to the last slide if at the beginning.
     */
    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        updateSliderPosition();
    }

    // Add event listeners to the navigation arrows
    nextArrow.addEventListener('click', nextSlide);
    prevArrow.addEventListener('click', prevSlide);

    let autoSlideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds

    // Pause auto-slide on hover for better user experience
    sliderList.parentNode.addEventListener('mouseenter', () => {
        clearInterval(autoSlideInterval);
    });

    sliderList.parentNode.addEventListener('mouseleave', () => {
        autoSlideInterval = setInterval(nextSlide, 5000);
    });

    // Initialize the slider position
    updateSliderPosition();
});
