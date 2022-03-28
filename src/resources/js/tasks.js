window.onload = Task;

function Task(){
    const tasks = document.querySelectorAll('.task');
    const trashcan = document.querySelector('.fa-trash-can');
    const takeBack = document.querySelector('#take-back');
    const exhaust = document.querySelector('#exhaust');

    if (tasks.length || trashcan || takeBack || exhaust) {
        
        for (let task of tasks) {
            task.addEventListener('click', event => {
                const taskContents = event.currentTarget.querySelector('.task-contents');
                taskContents.classList.toggle('hidden');
            });
    
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
            });
        }
    
        trashcan.addEventListener('click', () => {
            const loadIcon = document.querySelector('.load-icon')
            loadIcon.classList.remove('hidden');
            document.querySelector('.trashed-index').appendChild(loadIcon);
            
            fetch('/tasks/trashcan', {
                
            })
            .then(response => response.json())
            .then(data => {
                const ti = document.querySelector('.trashed-index');
                ti.innerHTML = '';
    
                if (data.length) {
                    data.forEach(t => {
                        const el = document.createElement('p');
                        el.setAttribute('class', 'px-3 py-1 hover:underline cursor-pointer');
                        el.textContent = t['title'] + ':' + t['contents'];
                        ti.appendChild(el);
                    })
                } else {
                    ti.innerHTML = 'ゴミ箱は空です。';
                }
            })
        });
    
        takeBack.addEventListener('click', () => {
            location.href="/tasks/restore";
        });
    
        exhaust.addEventListener('click', () => {
            location.href="/tasks/forceDelete";
        })
    }

    // 後で別ファイルで実行できるように修正する
    const button = document.querySelector('#time-button');
    const timer = document.querySelectorAll('#setTimer');
    const timerDisplay = document.querySelector('#timer-display');

    if (button !== null) {
        button.addEventListener('click', function() {

            let amount = timerDisplay.getAttribute('data-timer-amount');
            let now = new Date();
            let end = new Date(now.getTime() + amount * 1000);
            let time = end.getTime() // 残りtimestamp
            let intervalId = setInterval(function() {
                time -= 1000;
                let remain = time - now.getTime();
                timerDisplay.setAttribute('data-timer-amount', remain);
                let hour = Math.floor(remain / (60 * 1000));
                let min = Math.floor((remain % (60 * 1000)) / 1000);
                timerDisplay.textContent = hour + ':' + min;
                if (remain < 1) {
                    clearInterval(intervalId);
                    document.querySelector('#finish-icon').classList.remove('hidden');
                    let finishIntervalId = setTimeout(function() {
                        document.querySelector('#finish-icon').classList.add('hidden');
                    }, 3000)

                    // のちにここに何回達成したかを更新する同期処理を追加
                    location.reload();
                }

                for (let t of timer) {
                    t.addEventListener('click', () => {
                        clearInterval(intervalId);
                        clearInterval(finishIntervalId);
                    })
                }
            }, 1000);
            
        }, false);
    }

    if (timer.length) {
        for (let t of timer) {
            t.addEventListener('click', event => {
                let task_id = event.currentTarget.getAttribute('data-tasks-id');
                let url = "/home/" + task_id;
                let timer = document.querySelector('.timer');
                
                fetch(url, {
                
                })
                .then(response => response.json())
                .then(data => {
                    if (data["timer"]) {
                        timerDisplay.textContent = data["timer"] + ':00';
                        timerDisplay.setAttribute('data-timer-amount', data["timer"] * 60);
                    } else {
                        timerDisplay.textContent = '60:00'
                        timerDisplay.setAttribute('data-timer-amount', '1800');
                    }
                    
                })
                .catch(err => {
                    alert('通信に失敗しました。')
                })
            });    
        }
    }
}
