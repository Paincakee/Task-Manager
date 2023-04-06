let form = document.getElementById('register-form');

form.addEventListener('submit', function(e){

    e.preventDefault();

    let formData = new FormData(form);

    sendData(formData);
})

async function sendData(formData) {  
    try {
        const response = await fetch('api/sendData.php',{
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        console.log(text);

    } catch (error) {
        console.log(error);
    }
}