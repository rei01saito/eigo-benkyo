import { TaskFormValidate } from "./taskFormValidate.js";
export function TaskEvent(){

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

  if ($('.task').length) {  
    $('.task').each(function(index, element) {
      $(element).on('click', function() {
        $(this).find('.task-contents').toggleClass('hidden');
        $(this).find('.task-timer').toggleClass('hidden');
      });
  
      $(element).on('dblclick', function() {
        const taskId = $(this).data('taskid');
        if (confirm('削除しますか？')) {
  
          $(this).before($('.load-icon'));
          $(this).addClass('hidden');
          $('.load-icon').removeClass('hidden');
  
          let url = '/tasks/softDelete/' + taskId;
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
            $('.load-icon').addClass('hidden');
            $(this).remove();
          })
          .catch(err => {
            console.log('fail');
            $('.load-icon').addClass('hidden');
            $(this).removeClass('hidden');
          })
        }
      });
    })  
  }

  $('.edit-task').each(function(index, element) {
    $(element).on('click', function(){
      // あらかじめタスクたちにはdata属性を持たせておき、ここで挿入する
      $('#edit-form').find('input[name="title"]').val($(this).data('task-title'));
      $('#edit-form').find('input[name="contents"]').val($(this).data('task-contents'));
      $('#edit-form').find('input[name="timer"]').val($(this).data('task-timer'));
      $('#edit-form').find('input[name="priority"]').val($(this).closest('.task-index').data('priority-id'));
      $('#edit-form').find('input[name="tasks_id"]').val($(this).data('tasks-id'));
      
      let url = '/tasks/' + $(this).data('tasks-id');
      $('#edit-form').attr('action', url);
    });

    $(element).closest('button').on('click', function(e) {
      e.stopPropagation();
    })
  });

  $('.fa-trash-can').on('click', function() {
    $('.trashed-index').append($('.load-icon'));
    $('.load-icon').removeClass('hidden');
    
    fetch('/tasks/trashcan', {
        
    })
    .then(response => response.json())
    .then(data => {
      $('.trashed-index').html('');

      if (data.length) {
        data.forEach(t => {
          const el = $('<p></p>')
          el.attr('class', 'px-3 py-1 hover:underline cursor-pointer');
          el.text(t['title']);
          $('.trashed-index').append(el);
        })
      } else {
        $('.trashed-index').text('ゴミ箱は空です。');
      }
    })
  });

  $('#take-back').on('click', () => {
    location.href="/tasks/restore";
  });
  
  $('#exhaust').on('click', () => {
    location.href="/tasks/forceDelete";
  })

  TaskFormValidate($('#add-thinking'));
  TaskFormValidate($('#add-doing'));
  TaskFormValidate($('#add-done'));
  TaskFormValidate($('#edit-form'));
}
