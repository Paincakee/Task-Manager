const form = document.getElementById('createProject-form');

form.addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(form);

    sendData(formData);
})

async function sendData(formData) {
    try {
        const response = await fetch('api/project/createProject.php', {
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        console.log(text);

        if (text == "Created") {
            window.location.replace("projectCollection.php")
        } 
    } catch (error) {
        console.log(error);
    }
}
