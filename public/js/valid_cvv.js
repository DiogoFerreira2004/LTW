document.addEventListener('DOMContentLoaded', () => {
    const cvvInput = document.getElementById('cvvInput');

    cvvInput.addEventListener('input', () => {
        const cvv = cvvInput.value.trim();

        // Check if CVV is less than 3 characters
        if (cvv.length < 3) {
            cvvInput.setCustomValidity('CVV must be at least 3 digits long');
        } else if (cvv.length > 3) {
            cvvInput.setCustomValidity('CVV must be at most 3 digits long');
        } else {
            cvvInput.setCustomValidity('');
        }
    });
});