document.addEventListener('DOMContentLoaded', function() {
   
    function notifications() {
        fetch('./notifications') 
            .then(response => response.json()) 
            .then(data => {
              
                
                const notificationElement = document.querySelector('.notification');
                
                if (data.notification) {
                    if (notificationElement) notificationElement.style.display = 'block';
                    
                } else {
                    if (notificationElement) notificationElement.style.display = 'none';
                   
                }
            })
            .catch(error => console.error('Error fetching notifications:', error)); 
    }
    
    setInterval(notifications, 1000); 

       
    
});