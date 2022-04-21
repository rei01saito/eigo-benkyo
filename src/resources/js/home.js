export function HomeEvent() {

  // ログイン前
  $('#intro').fadeIn(1000);

  // ログイン後
  const timer = document.querySelectorAll('#setTimer');
  const timerDisplay = document.querySelector('#timer-display');
  let clickFlag = true;
  let stopFlag = false;
  let i_amount = 0;
  
  $('#start-button').on('click', function() {
    let amount = timerDisplay.getAttribute('data-timer-amount');
    if (amount == 0) {
      return false;
    }
    $(this).addClass('hidden');
    $('#stop-button').removeClass('hidden');
    
    if (!stopFlag) {
      // amount初期値
      i_amount = timerDisplay.getAttribute('data-timer-amount');
    }
    // console.log(i_amount)

    if (clickFlag && (amount > 0)) {
      
      let now = new Date();
      let end = new Date(now.getTime() + amount * 1000);
      let time = end.getTime() // 残りtimestamp
      
      let intervalId = setInterval(function() {
        amount = timerDisplay.getAttribute('data-timer-amount');

        time -= 1000;
        
        let remain = time - now.getTime();
        timerDisplay.setAttribute('data-timer-amount', remain / 1000);
        let hour = Math.floor(remain / (60 * 1000));
        let min = Math.floor((remain % (60 * 1000)) / 1000);
        timerDisplay.textContent = hour + ':' + ('0' + min).slice(-2);

        if (remain < 1) {
          clearInterval(intervalId);
          $('#finish-icon').removeClass('hidden');
          let finishIntervalId = setTimeout(function() {
            $('#finish-icon').addClass('hidden');
          }, 5000)

          location.reload();
        }

        for (let t of timer) {
          t.addEventListener('click', () => {
              clearInterval(intervalId);
              $('#spin').css('transform', 'rotate(0deg)');
              $('#stop-button').addClass('hidden');
              $('#start-button').removeClass('hidden');
              clickFlag = true;
              stopFlag = false;
          })
        }

        // console.log('i_amount: '+i_amount)
        // console.log('amount: '+amount)
        // console.log('remain: '+remain)
        
        let deg = (1 - ( (remain) / (i_amount * 1000))) * 360;
        console.log(deg)
        $('#spin').css('transform', 'rotate(' + deg + 'deg)');
      }, 1000);

      $('#stop-button').on('click', function() {
        clearInterval(intervalId);
        $(this).addClass('hidden');
        $('#start-button').removeClass('hidden');
        clickFlag = true;
        stopFlag = true;
        let stopNow = new Date();
      });
    }

      clickFlag = false;
  });

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
          $('#task-title').text(data["title"]);
        })
        .catch(err => {
          alert('通信に失敗しました。')
        })
      });    
    }
  }
}