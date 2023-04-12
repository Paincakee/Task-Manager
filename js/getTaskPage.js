async function getData() {
    try {
        const response = await fetch('api/getTaskPage.php', {
            method: 'GET',
        });

        const text = await response.text();

        // console.log(text);
        
        if (text == '<button id="complete-btn">Complete task</button>') {
            let btn = document.getElementById('btn-complete-spot');
            btn.innerHTML = '<button id="complete-btn">Complete task</button>';
          }
          

    } catch (error) {
        console.log(error);
    }
}