let btn_complete = document.getElementById('btn-complete-spot');

btn_complete.addEventListener('click', function(e){
    sendData();

    window.location.reload();
});

async function sendData() {
    try {
        const response = await fetch('api/tasks/completeTask.php', {
            method: 'GET'
        });

        const text = await response.text();

        console.log(text);

    } catch (error) {
        console.log(error);
    }
}
