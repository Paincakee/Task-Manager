const form = document.getElementById('register-form');

form.addEventListener('submit', function(e){

    e.preventDefault();

    let formData = new FormData(form);

    sendData(formData);
})

async function sendData(formData) {  
    try {
        const response = await fetch('api/account/sendAccount.php',{
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        console.log(text);
        const errorText = document.getElementById('error-text');
        errorText.innerHTML = text;
        if (text == "Created") {
            window.location.replace("login.php")
        }   

    } catch (error) {
        console.log(error);
    }
}