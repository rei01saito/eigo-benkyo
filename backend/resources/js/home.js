export function HomeEvent() {

  // ログイン前
  $('#intro').fadeIn(1000);

  // ログイン後
  const timer = $('.set-timer');
  const timerDisplay = $('#timer-display');
  let clickFlag = true;
  let stopFlag = false;
  let i_amount = 0;
  
  $('#start-button').on('click', function() {
    let amount = timerDisplay.data('timer-amount');
    if (amount == 0) {
      return false;
    }
    $(this).addClass('hidden');
    $('#stop-button').removeClass('hidden');
    
    if (!stopFlag) {
      // amount初期値
      i_amount = timerDisplay.data('timer-amount');
    }

    if (clickFlag && (amount > 0)) {
      
      let now = new Date();
      let end = new Date(now.getTime() + amount * 1000);
      let time = end.getTime() // 残りtimestamp
      
      let intervalId = setInterval(function() {
        amount = timerDisplay.data('timer-amount');

        time -= 1000;
        
        let remain = time - now.getTime();
        timerDisplay.data('timer-amount', remain / 1000);
        let hour = Math.floor(remain / (60 * 1000));
        let min = Math.floor((remain % (60 * 1000)) / 1000);
        timerDisplay.text(hour + ':' + ('0' + min).slice(-2));

        if (remain < 1) {
          clearInterval(intervalId);
          $('#finish-icon').removeClass('hidden');
          let finishIntervalId = setTimeout(function() {
            $('#finish-icon').addClass('hidden');
          }, 5000)

          let url = '/home/incrementNExec/' + $('#n-exec-increment').data('tasks-id-increment');
          location.href = url;
        }

        timer.each(function(index, element) {
          $(element).on('click', function() {
            clearInterval(intervalId);
            $('#spin').css('transform', 'rotate(0deg)');
            $('#stop-button').addClass('hidden');
            $('#start-button').removeClass('hidden');
            clickFlag = true;
            stopFlag = false;
          })
        })

        let deg = (1 - ( (remain) / (i_amount * 1000))) * 360;
        // console.log(deg)
        $('#spin').css('transform', 'rotate(' + deg + 'deg)');

      }, 1000);

      $('#stop-button').on('click', function() {
        clearInterval(intervalId);
        $(this).addClass('hidden');
        $('#start-button').removeClass('hidden');
        clickFlag = true;
        stopFlag = true;
      });
    }

    clickFlag = false;
  });

  if (timer.length) {
    timer.each(function(index, element) {
      $(element).on('click', function(event) {
        let task_id = $(event.currentTarget).data('tasks-id');
        let url = "/home/" + task_id;
        
        fetch(url, {
        
        })
        .then(response => response.json())
        .then(data => {
          timerDisplay.text(data["timer"] + ':00');
          timerDisplay.data('timer-amount', data["timer"] * 60);
          $('#task-title').text(data["title"]);
          $('#n-exec-increment').attr('data-tasks-id-increment', task_id);
        })
        .catch(err => {
          alert('通信に失敗しました。')
        })
      });    
    })
  }
}