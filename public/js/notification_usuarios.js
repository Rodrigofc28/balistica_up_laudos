document.addEventListener('DOMContentLoaded', function() {
   
    function checkNotificationsUsuarios() {
        fetch('./check-notifications-usuarios') 
            .then(response => response.json()) 
            .then(data => {
              
                const msElement = document.querySelector('.us');
                const notificationElement = document.querySelector('.notification');
                
                if (data.notificationUser) {
                    if (notificationElement) notificationElement.style.display = 'block';
                    if (msElement) msElement.style.display = 'block';
                } else {
                    if (notificationElement) notificationElement.style.display = 'none';
                    if (msElement) msElement.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error)); 
    }
    
    setInterval(checkNotificationsUsuarios, 1000); 

       
    
});