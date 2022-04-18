import { TaskFormValidate } from "./taskFormValidate.js";
export function TaskEvent(){

  // Task
  const tasks = document.querySelectorAll('.task');
  const trashcan = document.querySelector('.fa-trash-can');
  const takeBack = document.querySelector('#take-back');
  const exhaust = document.querySelector('#exhaust');

  $('.task').draggable({
    revert: true,
    revertDuration: 0
  });

  $('.trash-can').droppable({
    over: function(event, ui) {
      $('#trash-can').addClass('bg-gray-300');
    },
    out: function() {
      $('#trash-can').removeClass('bg-gray-300');
    },
    drop: function(event, ui) {
      if (confirm('削除しますか？') ) {
        let dragEl = ui.draggable[0];
        dragEl.remove();
        let taskId = dragEl.getAttribute('data-taskId');
        let url = '/tasks/softDelete/' + taskId;

        fetch(url, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(err => console.log(err));
      };
      $('#trash-can').removeClass('bg-gray-300')
    },
  })

  $('.task-card').droppable({
    drop: function(event, ui) {
      let dragEl = ui.draggable[0];
      let el = $(this).find('.task-index')
      $(dragEl).appendTo(el);

      // 非同期でpriorityを変更
      let priorityId = el.data('priority-id');
      let taskId = dragEl.getAttribute('data-taskId');
      let url = '/tasks/update/' + taskId + '/' + priorityId;
      fetch(url, {
        method: 'GET',
      })
      .then(response => response.json())
      .then(data => console.log(data))
      .catch(err => console.log(err));
    }
  })

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
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

  TaskFormValidate($('#add-thinking'));
  TaskFormValidate($('#add-doing'));
  TaskFormValidate($('#add-done'));

}
