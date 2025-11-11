
document.addEventListener('DOMContentLoaded', function () {
    const preloader = document.getElementById('preloader');
    const content = document.getElementById('content');
    const progressBar = document.getElementById('progressBar');

    // Simula o progresso de carregamento
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);

            // Aguarda um pouco para garantir que tudo foi carregado
            setTimeout(() => {
                preloader.classList.add('hidden');
                content.classList.add('visible');
            }, 500);
        }
        progressBar.style.width = progress + '%';
    }, 200);

    // Fallback: se a página demorar muito, força o carregamento após 5 segundos
    setTimeout(() => {
        if (progress < 100) {
            clearInterval(interval);
            progressBar.style.width = '100%';
            preloader.classList.add('hidden');
            content.classList.add('visible');
        }
    }, 5000);
});
