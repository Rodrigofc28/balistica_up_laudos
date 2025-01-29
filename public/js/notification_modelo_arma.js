document.addEventListener('DOMContentLoaded', function() {
   
    function checkNotifications() {
        fetch('./check-notifications')
            .then(response => response.json()) 
            .then(data => {
                
                const msElement = document.querySelector('.ms');
               
                
                if (data.hasNotifications) {
                  
                    if (msElement) msElement.style.display = 'block';
                } else {
                    
                    if (msElement) msElement.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error)); 
    }
   
    setInterval(checkNotifications, 1000); 

      
    
});
