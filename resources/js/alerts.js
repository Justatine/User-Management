document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alertPrompt');
    
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s ease-in-out';
        
        setTimeout(() => {
            alert.style.opacity = '0';
            
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 2000);
    });
}); 