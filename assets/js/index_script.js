document.addEventListener('DOMContentLoaded', () => {
    // Configurar popup cards
    const configurarCartaEmergente = (openSelector, popupId, closeBtnId) => {
        const openLink = document.querySelector(openSelector);
        const popup = document.getElementById(popupId);
        const closeBtn = document.getElementById(closeBtnId);

        if (openLink && popup && closeBtn) {
            openLink.addEventListener('click', (event) => {
                event.preventDefault();
                popup.style.display = 'flex';
            });

            closeBtn.addEventListener('click', () => {
                popup.style.display = 'none';
            });

            window.addEventListener('click', (event) => {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            });
        }
    };

    // Configurar popup cards
    configurarCartaEmergente('.open-card1', 'popup1', 'close-btn1');
    configurarCartaEmergente('.open-card2', 'popup2', 'close-btn2');
});