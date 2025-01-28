document.addEventListener('DOMContentLoaded', function() {
   
    function checkNotifications() {
        fetch('./check-notifications')
            .then(response => response.json()) 
            .then(data => {
                
                const msElement = document.querySelector('.ms');
                const notificationElement = document.querySelector('.notification');
                
                if (data.hasNotifications) {
                    if (notificationElement) notificationElement.style.display = 'block';
                    if (msElement) msElement.style.display = 'block';
                } else {
                    if (notificationElement) notificationElement.style.display = 'none';
                    if (msElement) msElement.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error)); 
    }
   
    setInterval(checkNotifications, 1000); 

      
    
});
