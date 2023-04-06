let form = document.getElementById('login-form');

form.addEventListener('submit', function(e){

    e.preventDefault();

    let formData = new FormData(form);

    sendData(formData);
})

async function sendData(formData) {  
    try {
        const response = await fetch('api/getData.php',{
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        console.log(text);
        if(text == "true") {
            console.log("yeah buuddy");
            window.location.replace("dashboard.php");
        }

    } catch (error) {
        console.log(error);
    }
}