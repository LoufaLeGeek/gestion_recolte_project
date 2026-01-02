// Auto-dismiss des messages après 5 secondes
document.addEventListener('DOMContentLoaded', function() {
    const messages = document.querySelectorAll('[data-auto-dismiss]');

    messages.forEach(message => {
        const duration = parseInt(message.getAttribute('data-auto-dismiss'));

        setTimeout(() => {
            message.style.opacity = '0';
            message.style.transform = 'translateY(-10px)';
            setTimeout(() => message.remove(), 300);
        }, duration);
    });
});