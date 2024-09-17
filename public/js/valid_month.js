document.addEventListener('DOMContentLoaded', () => {
    const expMonthInput = document.getElementById('expMonthInput');

    expMonthInput.addEventListener('input', () => {
        const expMonth = parseInt(expMonthInput.value, 10);

        // Check if expiration month is within the range of 1 to 12
        if (expMonth < 1 || expMonth > 12 || isNaN(expMonth)) {
            expMonthInput.setCustomValidity('Expiration month must be an integer between 1 and 12');
        } else {
            expMonthInput.setCustomValidity('');
        }
    });
});
