const replyButtons = document.querySelectorAll('.reply-button');

replyButtons.forEach((replyButton) => {
    const commentContainer = replyButton.closest('.commentContainer');

    const replyForm = commentContainer.querySelector('.reply-form');

    const cancelButton = replyForm.querySelector('button[type="button"]');

    replyForm.style.display = 'none';

    replyButton.addEventListener('click', () => {
        replyForm.style.display = 'block';
    });

    cancelButton.addEventListener('click', () => {
        replyForm.style.display = 'none';
    });
});