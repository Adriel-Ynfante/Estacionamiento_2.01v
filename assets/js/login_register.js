document.addEventListener('DOMContentLoaded', () => {
    const fondo = document.querySelector('.fondo');
    const loginLink = document.querySelector('.login-link');
    const registrarLink = document.querySelector('.registrar-link');
    const iconoCerrar = document.querySelector('.icono-cerrar');
    
    const toggleFondo = (isRegistering) => {
        fondo.classList.toggle('active', isRegistering);
    };

    registrarLink?.addEventListener('click', (e) => {
        e.preventDefault();
        toggleFondo(true);
    });

    loginLink?.addEventListener('click', (e) => {
        e.preventDefault();
        toggleFondo(false);
    });

    iconoCerrar?.addEventListener('click', () => {
        fondo.classList.remove('active-btn');
    });
});