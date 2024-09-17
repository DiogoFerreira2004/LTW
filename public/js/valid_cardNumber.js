document.addEventListener('DOMContentLoaded', () => {
    const cardNumberInput = document.getElementById('cardNumberInput');

    cardNumberInput.addEventListener('input', () => {
        const cardNumber = cardNumberInput.value.trim();

        // Check if card number is less than 16 characters
        if (cardNumber.length < 16) {
            cardNumberInput.setCustomValidity('Credit card number must be at least 16 digits long');
        }else if (cardNumber.length > 16) {
            cardNumberInput.setCustomValidity('Credit card number must be at most 16 digits long');
        } else {
            cardNumberInput.setCustomValidity('');
        }
    });
});