async function getData() {
    try {
        const response = await fetch('api/tasks/getTask.php', {
            method: 'GET',
        });

        const text = await response.text();

        // console.log(text);

    } catch (error) {
        console.log(error);
    }
}


async function getTasks(){
    await getData();

    const response = await fetch("api/tasks/getTaskTable.php")
    let text = await response.text()

    const taskDiv = document.getElementById('tasks');
    taskDiv.innerHTML = text;

    const taskWrappers = document.querySelectorAll('.task-wrapper');

    taskWrappers.forEach(taskWrapper => {
        taskWrapper.addEventListener('click', event => {
            const clickedTaskWrapper = event.target.closest('.task-wrapper');
            const taskId = clickedTaskWrapper.getAttribute('data-task-id');
            window.location.href = `taskInfo.php?id=${taskId}`; 
            console.log(taskId);
        });
    });
}
