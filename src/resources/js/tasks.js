window.onload = onTask;

function onTask(){
    const tasks = document.querySelectorAll('.task')
    for (let task of tasks) {
        task.addEventListener('click', event => {
            const taskContents = event.currentTarget.querySelector('.task-contents');
            taskContents.classList.toggle('hidden');
        })

        task.addEventListener('dblclick', event => {
            const taskId = event.currentTarget.getAttribute('data-taskId');
            confirm('削除しますか？')
        })
    }
}