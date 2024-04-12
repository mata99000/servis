import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('reset-input', () => {
        // Pretpostavljamo da je id input-a 'image-input'
        const input = document.getElementById('images');
        if (input) {
            input.value = '';  // Resetujemo input za fajlove
        }
    });
});