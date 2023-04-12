let button = document.getElementById('btn-complete-spot');

button.addEventListener('click', function(e){
    sendData();

    window.location.reload();
});

async function sendData() {
    try {
        const response = await fetch('api/completeTask.php', {
            method: 'GET'
        });

        const text = await response.text();

        console.log(text);

    } catch (error) {
        console.log(error);
    }
}
