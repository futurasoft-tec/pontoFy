document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('semesterChart').getContext('2d');

    // Dados do gráfico (exemplo)
    const data = {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
        datasets: [{
            label: 'Vendas em R$',
            data: [12000, 19000, 15000, 25000, 22000, 30000],
            backgroundColor: '#003e46',
            borderColor: '#00282e',
            borderWidth: 2,
            borderRadius: 4,
            hoverBackgroundColor: '#00525d'
        }]
    };

    // Configurações do gráfico
    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#333',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Primeiro Semestre - 2023',
                    color: '#003e46',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 62, 70, 0.1)'
                    },
                    ticks: {
                        color: '#003e46',
                        callback: function (value) {
                            return 'R$ ' + value.toLocaleString('pt-BR');
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 62, 70, 0.1)'
                    },
                    ticks: {
                        color: '#003e46'
                    }
                }
            }
        }
    };

    // Criar o gráfico
    new Chart(ctx, config);
});