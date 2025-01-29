document.addEventListener('DOMContentLoaded', function() {
   
    function checkNotificationsUsuarios() {
        fetch('./check-notifications-usuarios') 
            .then(response => response.json()) 
            .then(data => {
              
                const msElement = document.querySelector('.us');
               
                
                if (data.notificationUser) {
                    
                    if (msElement) msElement.style.display = 'block';
                } else {
                    
                    if (msElement) msElement.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error)); 
    }
    
    setInterval(checkNotificationsUsuarios, 1000); 

       
    
});