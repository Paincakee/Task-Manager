const form = document.getElementById('createTask-form');

form.addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(form);

    sendData(formData);
})

async function sendData(formData) {
    try {
        const response = await fetch('api/tasks/sendTask.php', {
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        console.log(text);

        if (text == "Created") {
            window.location.replace("task.php")
        } 
    } catch (error) {
        console.log(error);
    }
}