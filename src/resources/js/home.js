export function HomeEvent() {

  const timer = document.querySelectorAll('#setTimer');
  const timerDisplay = document.querySelector('#timer-display');
  let clickFlag = true;

  $('#time-button').on('click', function() {
    let amount = timerDisplay.getAttribute('data-timer-amount');
    if (clickFlag && (amount > 0)) {
      let now = new Date();
      let end = new Date(now.getTime() + amount * 1000);
      let time = end.getTime() // 残りtimestamp
      
      let intervalId = setInterval(function() {
        time -= 1000;
        let remain = time - now.getTime();
        timerDisplay.setAttribute('data-timer-amount', remain);
        let hour = Math.floor(remain / (60 * 1000));
        let min = Math.floor((remain % (60 * 1000)) / 1000);
        timerDisplay.textContent = hour + ':' + ('0' + min).slice(-2);
        if (remain < 1) {
          clearInterval(intervalId);
          document.querySelector('#finish-icon').classList.remove('hidden');
          let finishIntervalId = setTimeout(function() {
            document.querySelector('#finish-icon').classList.add('hidden');
          }, 5000)

          location.reload();
        }

        for (let t of timer) {
          t.addEventListener('click', () => {
              clearInterval(intervalId);
              clearInterval(finishIntervalId);
          })
        }
        
        let deg = (1 - ( remain / amount / 1000 )) * 360;
        console.log(deg)
        $('#spin').css('transform', 'rotate(' + deg + 'deg)');

      }, 1000);
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