async function getData() {
    try {
        const response = await fetch('api/tasks/getAgenda.php', {
            method: 'GET',
        });

        const text = await response.text();

        console.log(text);

    } catch (error) {
        console.log(error);
    }
}


