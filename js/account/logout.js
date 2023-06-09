let button = document.getElementById('logout-btn');

button.addEventListener('click', function(e){
    clearSessions();
});

// Make an AJAX call to a PHP script to clear sessions
async function clearSessions() {  
    try {
        const response = await fetch('api/account/logout.php',{
            method: 'POST'
        });

        
        window.location.replace("login.php");

    } catch (error) {
        console.log(error);
    }
}
