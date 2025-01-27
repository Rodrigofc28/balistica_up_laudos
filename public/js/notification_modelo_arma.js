document.addEventListener('DOMContentLoaded', function() {
    // Função para atualizar o estado das notificações armas
    function checkNotifications() {
        fetch('./check-notifications') // Faz a requisição à rota
            .then(response => response.json()) // Converte a resposta para JSON
            .then(data => {
                const notificationElement = document.querySelector('.notification');
                const msElement = document.querySelector('.ms');
                
                // Se houver notificações, exibe os elementos, caso contrário, oculta
                if (data.hasNotifications) {
                    if (notificationElement) notificationElement.style.display = 'block';
                    if (msElement) msElement.style.display = 'block';
                } else {
                    if (notificationElement) notificationElement.style.display = 'none';
                    if (msElement) msElement.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error)); // Tratamento de erro
    }
    // Executa a verificação a cada 1 segundo (1000ms)
    setInterval(checkNotifications, 1000); // Verifica a cada 1 segundo

        // Função para notificar sobre os usuarios
    
});
