// Placez ce script dans un fichier JS séparé, par exemple public/js/form-validation.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                    const errorMessage = document.createElement('p');
                    errorMessage.textContent = 'Ce champ est requis';
                    errorMessage.classList.add('text-red-500', 'text-sm', 'mt-1');
                    field.parentNode.appendChild(errorMessage);
                }
            });
            if (!isValid) {
                event.preventDefault();
            }
        });
    }
});
