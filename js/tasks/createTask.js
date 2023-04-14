const form = document.getElementById('createTask-form');



form.addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(form);

    sendData(formData);
})

async function sendData(formData) {
    try {
        const response = await fetch('api/tasks/createTask.php', {
            method: 'POST',
            body: formData
        });

        const text = await response.text();

        console.log(text);


        if (text == "Created") {
            const queryParams = new URLSearchParams(window.location.search);
            const id = queryParams.get('project_id');
            const name = queryParams.get('project_name');
            console.log(id);
            window.location.href = `project.php?project_id=${id}&project_name=${name}`; 
            
        } 
    } catch (error) {
        console.log(error);
    }
}