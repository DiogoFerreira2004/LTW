document.addEventListener('DOMContentLoaded', () => {
    const expMonthInput = document.getElementById('expMonthInput');
    const expYearInput = document.getElementById('expYearInput');

    expMonthInput.addEventListener('input', () => {
        updateExpYearMin();
    });

    function updateExpYearMin() {
        const expMonth = parseInt(expMonthInput.value, 10);
        const currentYear = new Date().getFullYear();

        // Determine the minimum year based on the expiration month
        const minYear = expMonth < 5 ? 2025 : 2024;

        // Set the minimum year for the expiration year input field
        expYearInput.min = minYear;

        // Validate the current year input
        validateExpYear();
    }

    expYearInput.addEventListener('input', () => {
        validateExpYear();
    });

    function validateExpYear() {
        const expYear = parseInt(expYearInput.value, 10);
        const currentYear = new Date().getFullYear();

        // Check if the expiration year is valid
        if (expYear < currentYear || isNaN(expYear)) {
            expYearInput.setCustomValidity('Expiration year must be a valid year');
        } else {
            expYearInput.setCustomValidity('');
        }
    }

    // Initial update of minimum year based on the expiration month
    updateExpYearMin();
});
