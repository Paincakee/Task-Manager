async function getData() {
    try {
        const response = await fetch('api/project/getProjects.php', {
            method: 'GET',
        });

        const text = await response.text();

        console.log(text);

    } catch (error) {
        console.log(error);
    }
}
async function getProjects(){
    await getData();

    const response = await fetch('api/project/getProjectsTable.php')
    let text = await response.text()

    const projectDiv = document.getElementById('projects');
    projectDiv.innerHTML = text;

    const projectWrappers = document.querySelectorAll('.projects-wrapper');

    projectWrappers.forEach(projectWrapper => {
        projectWrapper.addEventListener('click', event => {
            const clickedProjectWrapper = event.currentTarget;
            const projectId = clickedProjectWrapper.getAttribute('data-project-id');
            const projectName = clickedProjectWrapper.getAttribute('data-project-name');
            window.location.href = `project.php?project_id=${projectId}&project_name=${projectName}`;

        });
    });
}

// async function getProjects(){
//     await getData();

//     const response = await fetch('api/project/getProjectsTable.php')
//     let text = await response.text()

//     const projectDiv = document.getElementById('projects');
//     projectDiv.innerHTML = text;

//     const projectWrappers = document.querySelectorAll('.projects-wrapper');

//     projectWrappers.forEach(projectWrapper => {
//         projectWrapper.addEventListener('click', event => {
//             console.log(event.target);
//             console.log(event.target.closest('.project-wrapper'));
//             const clickedprojectWrapper = event.target.closest('.project-wrapper');
//             const projectId = clickedprojectWrapper.getAttribute('data-project-id');
//             window.location.href = `project.php?id=${projectId}`; 
//             console.log(projectId);
//         });
//     });
// }

