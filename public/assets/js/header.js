document.addEventListener('DOMContentLoaded', () => {
    const userIcon = document.querySelector('.user-icon');
    const userOption = document.querySelector('.user-option');

    if (userIcon && userOption) {
        userIcon.addEventListener('click', () => {
            console.log('User icon clicked');
            userOption.classList.toggle('hide');
        });
    }
});
