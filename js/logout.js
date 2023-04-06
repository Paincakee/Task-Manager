let button = document.getElementById('logout-btn');

button.addEventListener('click', function(e){
    clearSessions();
});

// Make an AJAX call to a PHP script to clear sessions
async function clearSessions() {  
    try {
        const response = await fetch('api/logout.php',{
            method: 'POST'
        });

        
        window.location.reload();

    } catch (error) {
        console.log(error);
    }
}
