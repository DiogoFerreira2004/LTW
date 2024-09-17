document.addEventListener('DOMContentLoaded', () => {
    const zipCodeInput = document.getElementById('zip_code');
    
    zipCodeInput.addEventListener('input', () => {
        const zipCodeValue = zipCodeInput.value.trim();
        const isValidLength = zipCodeValue.length === 4;
        
        zipCodeInput.setCustomValidity(
            isValidLength ? '' : 'Zip code must be 4 digits long.'
        );
    });
});
