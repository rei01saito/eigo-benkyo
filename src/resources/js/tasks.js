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
            if (confirm('削除しますか？')) {

                const loadIcon = document.querySelector('.load-icon')
                loadIcon.classList.remove('hidden');
                task.before(loadIcon);
                task.classList.add('hidden');

                const url = '/tasks/softDelete/' + taskId;
                fetch(url, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('success!');
                    loadIcon.classList.add('hidden');
                    task.remove();
                })
                .catch(err => {
                    console.log('fail');
                    loadIcon.classList.add('hidden');
                    task.classList.remove('hidden');
                })

            }
        })
    }
}