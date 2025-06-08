
document.addEventListener('DOMContentLoaded', () => {
    const message = document.getElementsByClassName('message')[0];
    let error = document.querySelectorAll('.error');
    let success = document.querySelectorAll('.success');

    if (error.length > 0) {

        error.forEach(element => {
            message.style.display = 'block';
            message.style.border = '1px solid rgb(247, 247, 247)';
            message.style.boxShadow = '2px 2px 2px rgb(247, 247, 247)';
            element.style.display = 'block';
        });

        setTimeout(() => {
            message.style.display = 'none';
            href.window.location = '/ukBlog/register';
        }, 6000);
    }

    if (success.length > 0) {

        success.forEach(element => {
            message.style.display = 'block';
            message.style.border = '1px solid rgb(247, 247, 247)';
            message.style.boxShadow = '2px 2px 2px rgb(247, 247, 247)';
            element.style.display = 'block';
        });

        setTimeout(() => {
            message.style.display = 'none';
            href.window.location = '/ukBlog/register';
        }, 6000);
    }
});
