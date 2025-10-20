// Função genérica para mostrar/esconder alertas
function handleAlert(alertId, duration = 5000) {
    const alertElement = document.getElementById(alertId);
    if (alertElement) {
        const alertBox = alertElement.querySelector('.alert');
        
        // Mostra o alerta
        setTimeout(() => {
            alertBox.classList.add('show');
        }, 100);
        
        // Configura o timeout para esconder
        const hideTimeout = setTimeout(() => {
            alertBox.classList.remove('show');
            // Remove o elemento do DOM após a animação
            setTimeout(() => {
                alertElement.remove();
            }, 450);
        }, duration);
        
        // Fechar ao clicar no botão
        const closeBtn = alertBox.querySelector('.alert-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                clearTimeout(hideTimeout);
                alertBox.classList.remove('show');
                setTimeout(() => {
                    alertElement.remove();
                }, 450);
            });
        }
    }
}

// Inicializa os alertas
document.addEventListener('DOMContentLoaded', function() {
    handleAlert('alertaSucesso');
    handleAlert('alertaErro');
});
